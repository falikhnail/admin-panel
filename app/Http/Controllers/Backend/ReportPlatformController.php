<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PlatformReportExport;
use App\Http\Controllers\Controller;
use App\Imports\PlatformReportImport;
use App\Models\PlatformsModel;
use App\Models\ReportGeneralModel;
use App\Models\ReportPlatform;
use App\Models\SessionKeyModel;
use App\Models\UserBalanceModel;
use App\Models\UserModel;
use DB;
use Flash;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;
use Yajra\DataTables\DataTables;

class ReportPlatformController extends Controller {

    public function index() {
        $user = UserModel::allUser();
        $platforms = PlatformsModel::all();

        return view('backend.report_platform', compact(
            'platforms',
            'user'
        ));
    }

    public function indexDataTable(Request $request) {
        $userSession = session()->get(SessionKeyModel::USER_LOGIN);

        // * filter
        $reportDate = $request->get('reportDate');

        $report = ReportGeneralModel::query()
            ->leftJoin('platforms', 'report_general.platform_id', '=', 'platforms.id')
            ->groupByRaw("report_general.users_id, report_general.platform_id, report_general.platform_imported, report_general.artist")
            ->orderBy('report_general.reporting_period', 'desc');

        if (!empty($reportDate)) {
            $report->whereRaw("DATE(report_general.created_at) = '$reportDate'");
        } else {
            $report->whereRaw("date(report_general.created_at) >= ADDDATE(LAST_DAY(SUBDATE(CURRENT_DATE, INTERVAL 1 MONTH)), 1)"); // FIRST_DAY OF CURRENT_DATE
        }

        $report = $report
            ->selectRaw("
                            IF(report_general.platform_id = 0, report_general.platform_imported, platforms.name) as platform,
                            report_general.artist,
                            sum(report_general.revenue) as revenue,
                            report_general.reporting_period
                        ");

        if ($userSession->tipe_user === 'user') {
            $sqlUser = "(report_general.users_id = $userSession->id or users_id in (select id from users where tipe_user =  'admin' and id = $userSession->id)) ";
            $sqlReleaseUser = "and (is_release = 1)";
            //Log::info($report->whereRaw($sqlUser)->toSql());
            $report = $report->whereRaw($sqlUser . $sqlReleaseUser);
        } else {

        }


        $dataTable = DataTables::of($report)
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

    public function create(Request $request) {
        $user = UserModel::allUser();
        $platforms = PlatformsModel::all();

        return view('backend.add_report_platform', compact(
            'user',
            'platforms'
        ));
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

            ReportPlatform::query()->insert([
                'users_id' => $userId,
                'platform_id' => $request->post('platform'),
                'artist' => $request->post('artist'),
                'revenue' => $request->post('revenue'),
                'reporting_period' => $request->post('reporting_period'),
                'is_release' => $isRelease,
                'release_date' => $realaseDate,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);


            UserBalanceModel::addRevenue($userId, $request->post('revenue'), 'revenue platform');

            Flash::success('Berhasil Menambahkan Data');

            DB::commit();

            return redirect()->route('backend.report_platform');
        } catch (Throwable $e) {
            DB::rollBack();

            Flash::error('Gagal Menambahkan Data, Error >>> ' . $e->getMessage());

            return redirect()->back();
        }
    }

    public function import(Request $request) {
        try {
            $file = $request->file('upload_file');

            Excel::import(new PlatformReportImport(
                $request->user_id,
                $request->reporting_period,
            ), $file);

            Flash::success('File Berhasil di Import');
        } catch (Throwable $e) {
            Flash::error('Error Upload >>> ' . $e->getMessage());
        }

        return back();
    }

    public function export(Request $request) {
        return Excel::download(new PlatformReportExport, 'Report Platform.xlsx');
    }

    private function releaseDate() {
        //$current_day = (int)date('j');
        /* if ($current_day < 10) {
            $firstDayNextMonth = date('Y-m-d', strtotime('+9 days', strtotime('first day of this month')));
        } else {
            $firstDayNextMonth = date('Y-m-d', strtotime('+9 days', strtotime('first day of next month')));
        } */
        $firstDayNextMonth = date('Y-m-d', strtotime('+9 days', strtotime('first day of this month')));

        return $firstDayNextMonth;
    }
}
