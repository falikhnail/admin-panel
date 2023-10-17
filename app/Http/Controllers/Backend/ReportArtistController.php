<?php

namespace App\Http\Controllers\Backend;

use App\Exports\GeneralReportExport;
use App\Http\Controllers\Controller;
use App\Imports\GeneralReportImport;
use App\Models\PlatformsModel;
use App\Models\ReportArtistModel;
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

class ReportArtistController extends Controller {

    public function index() {
        $user = UserModel::allUser();

        return view('backend.report_artist', compact(
            'user'
        ));
    }

    public function create() {
        $user = UserModel::allUser();

        return view('backend.add_report_artist', compact(
            'user',
        ));
    }

    public function indexDataTable(Request $request) {
        $userSession = session()->get(SessionKeyModel::USER_LOGIN);

        // * filter
        $reportDate = $request->get('reportDate');

        $report = ReportGeneralModel::query()->orderBy('report_general.reporting_period', 'desc');
        if (!empty($reportDate)) {
            $report->whereRaw("DATE(report_general.created_at) = '$reportDate'");
        }

        $report = $report
            ->select('report_general.*');

        if ($userSession->tipe_user === 'user') {
            $sqlUser = "(report_general.users_id = $userSession->id or users_id in (select id from users where tipe_user =  'admin' and id = $userSession->id)) ";
            $sqlReleaseUser = "and (is_release = 1)";
            //Log::info($report->whereRaw($sqlUser)->toSql());
            $generalData = $report->whereRaw($sqlUser . $sqlReleaseUser)->get();
        } else {
            $generalData = $report->get();
        }


        $dataTable = DataTables::of($generalData)
            ->addIndexColumn()
            ->addColumn('artist_name', '{{$artist}}')
            ->addColumn('revenue', '{{$revenue}}')
            ->addColumn('report_date', fn ($data) => date('Y-m-d', strtotime($data->reporting_period)))
            ->rawColumns([
                'artist_name',
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
}
