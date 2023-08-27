<?php

namespace App\Http\Controllers\Backend;

use App\Exports\GeneralReportExport;
use App\Http\Controllers\Controller;
use App\Imports\GeneralReportImport;
use App\Models\PlatformsModel;
use App\Models\ReportChannelModel;
use App\Models\ReportGeneralModel;
use App\Models\SessionKeyModel;
use App\Models\UserBalanceModel;
use App\Models\UserModel;
use DB;
use Flash;
use Illuminate\Http\Request;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;
use Yajra\DataTables\DataTables;

class ReportChannelController extends Controller
{

    public function index() {
        $user = UserModel::allUser();

        return view('backend.report_channel', compact(
            'user'
        ));
    }

    public function create() {
        $user = UserModel::allUser();

        return view('backend.add_report_channel', compact(
            'user',
        ));
    }

    public function indexDataTable(Request $request) {
        $userSession = session()->get(SessionKeyModel::USER_LOGIN);

        // * filter
        $reportDate = $request->get('reportDate');

        $generalReport = ReportGeneralModel::query();
        if (!empty($reportDate)) {
            $generalReport->whereRaw("DATE(report_general.created_at) = '$reportDate'");
        }

        $generalReport = $generalReport->select('report_general.*');

        if ($userSession->tipe_user === 'user') {
            $sqlUser = "(report_general.users_id = $userSession->id or users_id in (select id from users where tipe_user =  'admin' and id = $userSession->id))";
            //Log::info($generalReport->whereRaw($sqlUser)->toSql());
            $generalData = $generalReport->whereRaw($sqlUser)->get();
        } else {
            $generalData = $generalReport->get();
        }


        $dataTable = DataTables::of($generalData)
            ->addIndexColumn()
            ->addColumn('label_name', '{{$label_name}}')
            ->addColumn('channel_name', '{{$channel_name}}')
            //->addColumn('channel_id', '{{$channel_id}}')
            ->addColumn('revenue', '{{$revenue}}')
            ->addColumn('report_date', fn ($data) => date('Y-m-d', strtotime($data->reporting_period)))
            ->rawColumns([
                'label_name',
                'channel_name',
                //'channel_id',
                'revenue',
                'report_date',
            ]);


        if ($userSession->tipe_user === '') {
            $dataTable->addColumn('action', function ($data) {
                //$data as $id
                //return view('includes.alumni_actions', compact('data'));
            });
        }

        return $dataTable->make(true);
    }

    public function store(Request $request) {
        //\Log::warning('request ', $request->all());

        DB::beginTransaction();
        try {
            $userId = $request->post('user_id');
            ReportChannelModel::query()->insert([
                'users_id' => $userId,
                'label_name' => $request->post('label_name'),
                'channel_name' => $request->post('channel_name'),
                'channel_id' => $request->post('channel_id'),
                'revenue' => $request->post('revenue'),
            ]);


            UserBalanceModel::addRevenue($userId, $request->post('revenue'));

            Flash::success('Berhasil Menambahkan Data');

            DB::commit();

            return redirect('control/report-general');
        } catch (Throwable $e) {
            DB::rollBack();

            Flash::error('Gagal Menambahkan Data, Error >>> ' . $e->getMessage());

            return redirect()->back();
        }
    }

    public function export(Request $request) {
        return Excel::download(new GeneralReportExport, 'Report Channel.xlsx');
    }

    public function import(Request $request) {
        try {
            $file = $request->file('upload_file');

            Excel::import(new GeneralReportImport($request->user_id), $file);

            Flash::success('File Berhasil di Import');
        } catch (Throwable $e) {
            Flash::error('Error Upload >>> ' . $e->getMessage());
        }

        return back();
    }
}
