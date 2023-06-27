<?php

namespace App\Http\Controllers\Backend;

use App\Exports\GeneralReportExport;
use App\Http\Controllers\Controller;
use App\Imports\GeneralReportImport;
use App\Models\ReportGeneralModel;
use App\Models\SessionKeyModel;
use App\Models\UserModel;
use DB;
use Flash;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;
use Yajra\DataTables\DataTables;

class ReportController extends Controller {

    public function general() {
        return view('backend.report_general');
    }

    public function addGeneral() {
        $user = UserModel::allUser();

        return view('backend.add_report_general', compact(
            'user',
        ));
    }

    public function generalDataTable(Request $request) {
        $userSession = session()->get(SessionKeyModel::USER_LOGIN);

        // * filter
        $platform = $request->get('platform');
        $accountingPeriod = $request->get('accountringPeriod');

        $generalReport = ReportGeneralModel::query();
        if (!empty($accountingPeriod)) {
            $generalReport->where('reporting_period', $accountingPeriod);
        }
        if (!empty($platform)) {
            $generalReport->where('platform', $platform);
        }

        if ($userSession->tipe_user === 'user') {
            $generalData = $generalReport->byUserId($userSession->id)->get();
        } else {
            $generalData = $generalReport->get();
        }


        $dataTable = DataTables::of($generalData)
            ->addIndexColumn()
            ->addColumn('reporting_period', '<strong>{{ $reporting_period }}</strong>')
            ->addColumn('platform', '<strong>{{$platform}}</strong>')
            ->addColumn('label_name', '<strong>{{$label_name}}</strong>')
            ->addColumn('artist', '<strong>{{$artist}}</strong>')
            ->addColumn('album', '<strong>{{$album}}</strong>')
            ->addColumn('title', '<strong>{{$title}}</strong>')
            ->addColumn('isrc', '<strong>{{$isrc}}</strong>')
            ->addColumn('upc', '<strong>{{$upc}}</strong>')
            ->addColumn('revenue', '<strong>{{$revenue}}</strong>')
            ->rawColumns([
                'reporting_period',
                'platform',
                'label_name',
                'artist',
                'album',
                'title',
                'isrc',
                'upc',
                'revenue'
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
        \Log::warning('request ', $request->all());

        DB::beginTransaction();
        try {
            ReportGeneralModel::query()->insert([
                'users_id' => $request->post('user_id'),
                'reporting_period' => $request->post('reporting_period'),
                'platform' => $request->post('platform'),
                'label_name' => $request->post('label_name'),
                'artist' => $request->post('artist'),
                'album' => $request->post('album'),
                'title' => $request->post('title'),
                'isrc' => $request->post('isrc'),
                'upc' => $request->post('upc'),
                'revenue' => $request->post('revenue'),
            ]);

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
            \Log::warning($request);
            $file = $request->file('upload_file');

            Excel::import(new GeneralReportImport(), $file);

            Flash::success('File Berhasil di Import');
        } catch (Throwable $e) {
            Flash::error('Error Upload >>> ' . $e->getMessage());
        }

        return back();
    }
}
