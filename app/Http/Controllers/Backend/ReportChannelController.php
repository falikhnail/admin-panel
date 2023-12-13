<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ChannelReportExport;
use App\Exports\GeneralReportExport;
use App\Http\Controllers\Controller;
use App\Imports\ChannelReportImport;
use App\Imports\GeneralReportImport;
use App\Models\ReportChannelModel;
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

class ReportChannelController extends Controller {

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

        $generalReport = ReportChannelModel::query()
            ->groupByRaw("report_channel.users_id, report_channel.label_name, report_channel.channel_name")
            ->orderBy('report_channel.reporting_period', 'desc');

        if (!empty($reportDate)) {
            $generalReport->whereRaw("DATE(report_channel.created_at) = '$reportDate'");
        } else {
            $generalReport->whereRaw("date(report_channel.created_at) >= ADDDATE(LAST_DAY(SUBDATE(CURRENT_DATE, INTERVAL 1 MONTH)), 1)"); // FIRST_DAY OF CURRENT_DATE
        }

        $generalReport = $generalReport->select('report_channel.*');

        if ($userSession->tipe_user === 'user') {
            $sqlUser = "(report_channel.users_id = $userSession->id or users_id in (select id from users where tipe_user =  'admin' and id = $userSession->id)) ";
            $sqlReleaseUser = "and (is_release = 1)";

            //Log::info($generalReport->whereRaw($sqlUser)->toSql());
            $generalData = $generalReport->whereRaw($sqlUser . $sqlReleaseUser)->get();
        } else {
            $generalData = $generalReport->get();
        }


        $dataTable = DataTables::of($generalData)
            ->addIndexColumn()
            ->addColumn('label_name', '{{$label_name}}')
            ->addColumn('channel_name', '{{$channel_name}}')
            ->addColumn('channel_id', '{{$channel_id}}')
            ->addColumn('revenue', '{{$revenue}}')
            ->addColumn('report_date', fn ($data) => date('Y-m-d', strtotime($data->reporting_period)))
            ->rawColumns([
                'label_name',
                'channel_name',
                'channel_id',
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
        DB::beginTransaction();
        try {
            $userId = $request->post('user_id');
            $realaseDate = $this->releaseDate();
            $isRelease = 0;
            if (((int)date('j')) >= 10) {
                $isRelease = 1;
            }

            ReportChannelModel::query()->insert([
                'users_id' => $userId,
                'label_name' => $request->post('label_name'),
                'channel_name' => $request->post('channel_name'),
                'channel_id' => $request->post('channel_id'),
                'revenue' => $request->post('revenue'),
                'reporting_period' => $request->post('reporting_period'),
                'release_date' => $realaseDate,
                'is_release' => $isRelease,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);


            UserBalanceModel::addRevenue($userId, $request->post('revenue'), 'revenue general');

            Flash::success('Berhasil Menambahkan Data');

            DB::commit();

            return redirect()->route('backend.report_channel');
        } catch (Throwable $e) {
            DB::rollBack();

            Flash::error('Gagal Menambahkan Data, Error >>> ' . $e->getMessage());

            return redirect()->back();
        }
    }

    public function export(Request $request) {
        return Excel::download(new ChannelReportExport, 'Report Channel.xlsx');
    }

    public function import(Request $request) {
        try {
            $file = $request->file('upload_file');

            Excel::import(new ChannelReportImport(
                $request->user_id,
                $request->reporting_period,
            ), $file);

            Flash::success('File Berhasil di Import');
        } catch (Throwable $e) {
            Flash::error('Error Upload >>> ' . $e->getMessage());
        }

        return back();
    }

    private function releaseDate() {
        $firstDayNextMonth = date('Y-m-d', strtotime('+9 days', strtotime('first day of this month')));

        return $firstDayNextMonth;
    }
}
