<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ReportGeneralModel;
use App\Models\SessionKeyModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReportPlatformController extends Controller {

    public function index() {
        return view('backend.report_platform');
    }

    public function indexDataTable(Request $request) {
        $userSession = session()->get(SessionKeyModel::USER_LOGIN);

        // * filter
        $reportDate = $request->get('reportDate');

        $report = ReportGeneralModel::query()
            ->leftJoin('platforms', 'report_general.platform_id', '=', 'platforms.id')
            ->groupByRaw("report_general.users_id, MONTH(report_general.reporting_period)")
            ->orderBy('report_general.reporting_period', 'desc');

        if (!empty($reportDate)) {
            $report->whereRaw("DATE(report_general.created_at) = '$reportDate'");
        }

        $report = $report
            ->selectRaw("
                            platforms.name as platform,
                            report_general.artist,
                            sum(report_general.revenue) as revenue,
                            report_general.reporting_period
                        ");

        if ($userSession->tipe_user === 'user') {
            $sqlUser = "(report_general.users_id = $userSession->id or users_id in (select id from users where tipe_user =  'admin' and id = $userSession->id)) ";
            $sqlReleaseUser = "and (is_release = 1)";
            //Log::info($report->whereRaw($sqlUser)->toSql());
            $generalData = $report->whereRaw($sqlUser . $sqlReleaseUser);
        } else {
            $generalData = $report;
        }


        $dataTable = DataTables::of($generalData)
            ->addIndexColumn()
            ->addColumn('platform', '{{$platform}}')
            ->addColumn('artist', '{{$artist}}')
            ->addColumn('revenue', '{{$revenue}}')
            ->rawColumns([
                'platform',
                'artist',
                'revenue',
            ]);


        if ($userSession->tipe_user === '') {
            $dataTable->addColumn('action', function ($data) {
                //$data as $id
                //return view('includes.alumni_actions', compact('data'));
            });
        }

        return $dataTable->make(true);
    }
}
