<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankAccountModel;
use App\Models\SessionKeyModel;
use App\Models\UserBalanceModel;
use App\Models\UserModel;
use App\Models\WithdrawModel;
use Carbon\Carbon;
use DB;
use Flash;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Log;
use Session;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class WithdrawsController extends Controller {

    public $userSession;

    public function __construct() {
        $this->userSession = session()->get(SessionKeyModel::USER_LOGIN);
    }

    public function index() {
        $isAdmin = $this->userSession->tipe_user === 'admin';
        $bankAccount = $isAdmin ? [] : UserModel::lastBalanceByUserId($this->userSession->id);
        $balance = $isAdmin ? 0 : (!empty($bankAccount) ? $bankAccount->balance : 0);

        return view('backend.withdraws', compact(
            'bankAccount',
            'balance'
        ));
    }

    public function indexDataTable(Request $request) {
        $withdraws = WithdrawModel::query()->orderByRaw('withdraws.request_date desc, withdraws.updated_at desc');
        if ($this->userSession->tipe_user === 'user') {
            $withdraws->where('users_id', $this->userSession->id);
        }

        $witdrawsData = $withdraws->get();

        $dataTable = DataTables::of($witdrawsData)
            ->addIndexColumn();
        if ($this->userSession->tipe_user === 'admin') {
            $dataTable->addColumn('user', function (WithdrawModel $wd) {
                $user = UserModel::byId($wd->users_id)->first();
                return '<div class="text-center"><strong>' . $user->nama  . '</strong></div>';
            });
        }

        $dataTable
            ->addColumn('amount', function (WithdrawModel $wd) {
                return '<div class="text-center"><strong>' . format_usd($wd->amount) . '</strong></div>';
            })
            ->addColumn('request_date', '<div class="text-center"><strong>{{$request_date}}</strong></div>')
            ->addColumn('status', function (WithdrawModel $wd) {

                return $this->statusStyle($wd->status);
            })
            ->addColumn('action', function (WithdrawModel $wd) {
                $lastBalance =  UserModel::lastBalanceByUserId($wd->users_id);
                $balance = !empty($lastBalance) ? $lastBalance->balance : 0;
                $urlInvoice = route('backend.withdraws_invoice', [$wd->id]);

                return view('backend.includes.act_wd', compact('wd', 'balance', 'urlInvoice'));
            })
            ->rawColumns([
                'user',
                'amount',
                'request_date',
                'status',
                'action'
            ]);

        return $dataTable->make(true);
    }

    private function statusStyle($status) {
        switch ($status) {
            case 'approved':
                return '<div class="text-center"><strong><span class="badge bg-success p-2">' . ucwords($status) . '</span></div>';
            case 'pending':
                return '<div class="text-center"><strong><span class="badge bg-warning p-2">' . ucwords($status) . '</span></div>';
            case 'declined':
                return '<div class="text-center"><strong><span class="badge bg-danger p-2">' . ucwords($status) . '</span></div>';
            default:
                return '<div class="text-center"><strong><span class="badge bg-primary p-2">' . ucwords($status) . '</span></div>';
        }
    }

    public function withdrawRequest(Request $request) {
        DB::beginTransaction();
        try {
            $validateBalance = UserModel::lastBalanceByUserId($request->userId);
            $balance = !empty($validateBalance) ? ((int)$validateBalance->balance) : 0;
            if ($balance === 0) {
                Flash::error('Balance Tidak Mencukupi');

                return back();
            } elseif ((int) $request->amount > $balance) {
                Flash::error('Amount Melebihi Balance');

                return back();
            } elseif ((int) $request->amount < 50.0) {
                Flash::error('Amount Harus Lebih dari $50.00');

                return back();
            } elseif ((int)$request->amount === 0) {
                Flash::error('Amount Harus Lebih dari $0.00');

                return back();
            }


            $pendingData = WithdrawModel::query()
                ->where('users_id', $request->userId)
                ->where('status', 'pending')
                ->count();
            if ($pendingData > 0) {
                throw new \Exception("Can't add new withdraws request, please wait previous withdraws approve by admin");
            }

            WithdrawModel::query()->insert([
                'users_id' => $request->userId,
                'amount' => $request->amount,
                'request_date' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'status' => 'pending'
            ]);

            DB::commit();

            Flash::success('Withdraws Berhasil, Status Pending');

            return back();
        } catch (Throwable $e) {
            DB::rollBack();

            //Log::warning('Error Withdraws, Error >>> ' . $e->getMessage());
            Flash::error($e->getMessage());

            return back()->withErrors([
                'reopenModal' => true
            ]);
        }
    }

    public function approveWithdraw(Request $request) {
        DB::beginTransaction();
        try {
            $withdraw = WithdrawModel::byId($request->withdrawId)->first();
            if (empty($withdraw)) {
                Flash::error('Withdraw Tidak Valid');

                return back();
            }

            $status = $request->status;
            WithdrawModel::byId($request->withdrawId)->update([
                'status' => $status,
                'updated_at' => Carbon::now(),
            ]);

            if ($status === 'approved') {
                $validateBalance = UserModel::lastBalanceByUserId($withdraw->users_id);
                $balance = !empty($validateBalance) ? ((int)$validateBalance->balance) : 0;

                UserBalanceModel::query()->insert([
                    'users_id' => $withdraw->users_id,
                    'kredit' => $withdraw->amount,
                    'debit' => 0.0,
                    'balance' => $balance - (int)$withdraw->amount,
                    'keterangan' => 'withdraws',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }

            DB::commit();

            Flash::success('Withdraws Berhasil di Approve');

            return back();
        } catch (Throwable $e) {
            DB::rollBack();

            Flash::error('Error Approve Withdraws, Error >>> ' . $e->getMessage());

            return back()->withErrors([
                'reopenModal' => true
            ]);
        }
    }

    public function invoiceWithdraws($id) {
        $withdraws = WithdrawModel::invoiceWithdrawsById($id);
        $invNumb = date('dmy', strtotime($withdraws->request_date)) . "-$id";
        $currency = $this->currencyConverter();
        $finalCurrency = count($currency) > 0 && array_key_exists('idr', $currency) ?  $currency['idr'] : 0;
        if ($finalCurrency > 0) {
            $finalCurrency -= 200;
        }

        return view('backend.invoice_withdraws', compact(
            'withdraws',
            'finalCurrency',
            'invNumb'
        ));
    }

    public function currencyConverter() {
        $currencyUrl = "https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies/";
        $usdToIdr = "usd/idr.json";
        $finalUrl = $currencyUrl . $usdToIdr;

        $client = new Client();
        $request = $client->get($finalUrl);
        return json_decode($request->getBody(), true);
    }
}
