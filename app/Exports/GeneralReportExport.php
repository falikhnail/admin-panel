<?php

namespace App\Exports;

use App\Models\ReportGeneralModel;
use App\Models\SessionKeyModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Session;

class GeneralReportExport implements FromCollection, WithHeadings {

    private $userSession;

    public function __construct() {
        $this->userSession = Session::get(SessionKeyModel::USER_LOGIN);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        /* if ($this->userSession->tipe_user === 'admin') {
            $data = ReportGeneralModel::byUserId($this->userSession->id)->get();
        } else {
            $data = [];
        } */
        $data = ReportGeneralModel::all();
        return (object)$data;
    }

    public function headings(): array {
        $general = new ReportGeneralModel();
        return $general->getColumnName();
    }
}
