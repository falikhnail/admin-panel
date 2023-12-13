<?php

namespace App\Exports;

use App\Models\ReportChannelModel;
use App\Models\ReportGeneralModel;
use App\Models\ReportPlatform;
use App\Models\SessionKeyModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Session;

class ChannelReportExport implements FromCollection, WithHeadings
{
    private $userSession;

    public function __construct() {
        $this->userSession = Session::get(SessionKeyModel::USER_LOGIN);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        if ($this->userSession->tipe_user === 'admin') {
            $data = ReportChannelModel::all();
        } else {
            $data = ReportChannelModel::query()
                ->where('users_id', $this->userSession->id)
                ->get();
        }

        //$data = ReportGeneralModel::all();

        return (object)$data;
    }

    public function headings(): array {
        $general = new ReportChannelModel();
        return $general->getColumnName();
    }
}
