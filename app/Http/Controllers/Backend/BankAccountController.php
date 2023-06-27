<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankAccountModel;
use App\Models\SessionKeyModel;
use Carbon\Carbon;
use DB;
use Flash;
use Illuminate\Http\Request;
use Throwable;

class BankAccountController extends Controller {
    public function store() {
        $userSession = session()->get(SessionKeyModel::USER_LOGIN);

        return response([
            'data' => BankAccountModel::byId($userSession->id),
        ]);
    }

    public function saveBankAccount(Request $request) {
        DB::beginTransaction();
        try {
            $byUserId = BankAccountModel::byUserId($request->post('userId'))->first();
            $data = [
                'bank_name' => $request->post('bank_name'),
                'account_number' => $request->post('account_number'),
                'account_name' => $request->post('account_name'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            if (empty($byUserId)) {
                $data['users_id'] = $request->userId;
                BankAccountModel::query()->insert($data);
            } else {
                BankAccountModel::byUserId($request->userId)->update($data);
            }

            Flash::success('Bank Acocunt Berhasil di Update');

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            Flash::overlay('Bank Account Gagal di Update, Error >>> ' . $e->getMessage(), 'error');
        }

        return redirect()->back();
    }
}
