<?php

namespace App\Http\Controllers\Backend;

use App\Exports\GeneralReportExport;
use App\Http\Controllers\Controller;
use App\Imports\GeneralReportImport;
use App\Models\PlatformsModel;
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

class ReportController extends Controller {

    public function general() {
        $user = UserModel::allUser();
        $platforms = PlatformsModel::all();

        return view('backend.report_general', compact(
            'platforms',
            'user'
        ));
    }

    public function addGeneral() {
        $user = UserModel::allUser();
        $platforms = PlatformsModel::all();

        return view('backend.add_report_general', compact(
            'user',
            'platforms'
        ));
    }

    public function generalDataTable(Request $request) {
        $userSession = session()->get(SessionKeyModel::USER_LOGIN);

        // * filter
        $platformId = $request->get('platform');
        $accountingPeriod = $request->get('accountringPeriod');

        $generalReport = ReportGeneralModel::query()
            ->leftJoin('platforms', 'report_general.platform_id', '=', 'platforms.id')
            ->orderBy('report_general.reporting_period', 'desc');

        if (!empty($accountingPeriod)) {
            $generalReport->where('report_general.reporting_period', $accountingPeriod);
        } else {
            $generalReport->whereRaw("date(report_general.created_at) >= ADDDATE(LAST_DAY(SUBDATE(CURRENT_DATE, INTERVAL 1 MONTH)), 1)"); // FIRST_DAY OF CURRENT_DATE
        }

        if ((int)$platformId > 0) {
            $generalReport->where('report_general.platform_id', $platformId);
        }

        $generalReport = $generalReport
            ->select('report_general.*')
            ->selectRaw("platforms.name as platform");

        if ($userSession->tipe_user === 'user') {
            $sqlUser = "(report_general.users_id = $userSession->id or users_id in (select id from users where tipe_user =  'admin' and id = $userSession->id)) ";
            $sqlReleaseUser = "and (report_general.is_release = 1) ";
            //Log::info($generalReport->whereRaw($sqlUser)->toSql());
            $generalData = $generalReport->whereRaw($sqlUser . $sqlReleaseUser)->get();
        } else {
            $generalData = $generalReport->get();
        }


        $dataTable = DataTables::of($generalData)
            ->addIndexColumn()
            ->addColumn('reporting_period', '<strong>{{ $reporting_period }}</strong>')
            ->addColumn('platform', function ($data) {
                $p = empty($data->platform) ? 'Not Match' : $data->platform;
                return '<strong>' . $p . '</strong>';
            })
            ->addColumn('label_name', '<strong>{{$label_name}}</strong>')
            ->addColumn('artist', '<strong>{{$artist}}</strong>')
            ->addColumn('album', '<strong>{{$album}}</strong>')
            ->addColumn('title', '<strong>{{$title}}</strong>')
            ->addColumn('isrc', '<strong>{{$isrc}}</strong>')
            ->addColumn('upc', '<strong>{{$upc}}</strong>')
            ->addColumn('revenue', '<strong>{{$revenue}}</strong>')
            ->addColumn('quantity', '<strong>{{$quantity}}</strong>')
            ->addColumn('sales_type', '<strong>{{$sales_type}}</strong>')
            ->rawColumns([
                'reporting_period',
                'platform',
                'label_name',
                'artist',
                'album',
                'title',
                'isrc',
                'upc',
                'revenue',
                'quantity',
                'sales_type'
            ]);


        if ($userSession->tipe_user === '') {
            $dataTable->addColumn('action', function ($data) {
                //$data as $id
                //return view('includes.alumni_actions', compact('data'));
            });
        }

        return $dataTable->make(true);
    }

    public function saveGeneral(Request $request) {
        //\Log::warning('request ', $request->all());

        DB::beginTransaction();
        try {
            $userId = $request->post('user_id');
            $realaseDate = $this->releaseDate();
            $isRelease = 0;
            if (((int)date('j')) >= 10) {
                $isRelease = 1;
            }

            ReportGeneralModel::query()->insert([
                'users_id' => $userId,
                'reporting_period' => $request->post('reporting_period'),
                'platform_id' => $request->post('platform'),
                'label_name' => $request->post('label_name'),
                'artist' => $request->post('artist'),
                'album' => $request->post('album'),
                'title' => $request->post('title'),
                'isrc' => $request->post('isrc'),
                'upc' => $request->post('upc'),
                'revenue' => $request->post('revenue'),
                'channel_name' => $request->post('channel_name'),
                'quantity' => $request->post('quantity'),
                'sales_type' => $request->post('sales_type'),
                'is_release' => $isRelease,
                'release_date' => $realaseDate,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);


            UserBalanceModel::addRevenue($userId, $request->post('revenue'), 'revenue general');

            Flash::success('Berhasil Menambahkan Data');

            DB::commit();

            return redirect('control/report-general');
        } catch (Throwable $e) {
            DB::rollBack();

            Flash::error('Gagal Menambahkan Data, Error >>> ' . $e->getMessage());

            return redirect()->back();
        }
    }

    public function exportGeneral(Request $request) {
        return Excel::download(new GeneralReportExport, 'Report General.xlsx');
    }

    public function importGeneral(Request $request) {
        try {
            $file = $request->file('upload_file');

            Excel::import(new GeneralReportImport(
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
