<?php

namespace App\Imports;

use App\Models\ReportGeneralModel;
use App\Models\SessionKeyModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Session;

class GeneralReportImport implements ToArray {

    private $userSession;

    private $headerKeys = [
        'no',
        'reporting_period',
        'platform',
        'label_name',
        'artist',
        'album',
        'title',
        'isrc',
        'upc',
        'revenue',
    ];

    public function __construct() {
        $this->userSession = Session::get(SessionKeyModel::USER_LOGIN);
    }

    /**
     * @param array $array
     */
    public function array(array $array) {
        foreach ($array as $key => $values) {
            if ($key === 0) {
                $validate = $this->validateHeaderWithRowNumber($array[0]);
                if (!empty($validate)) {
                    throw new Exception($validate);
                }
            } else {
                $data = [
                    'users_id' => $this->userSession->id,
                    'reporting_period' => $values[1] ?: null,
                    'platform' => $values[2] ?: null,
                    'label_name' => $values[3] ?: null,
                    'artist' => $values[4] ?: null,
                    'album' => $values[5] ?: null,
                    'title' => $values[6] ?: null,
                    'isrc' => $values[7] ?: null,
                    'upc' => $values[8] ?: null,
                    'revenue' => $values[9] ?: null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                ReportGeneralModel::query()->insert($data);
            }
        }
    }

    private function validateHeaderWithRowNumber($headers) {
        $message = [];
        foreach ($headers as $key => $value) {
            $header = $value;
            if ($key === 0 && $header !== $this->headerKeys[0]) {
                $message[] = 'Posisikan Cell Header No Sesusai Template Upload';
            }
            if ($key === 1 && $header !== $this->headerKeys[1]) {
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[1] . ' Part Sesusai Template Upload';
            }
            if ($key === 2 && $header !== $this->headerKeys[2]) {
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[2] . ' Sesusai Template Upload';
            }
            if ($key === 3 && $header !== $this->headerKeys[3]) {
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[3] . ' Sesusai Template Upload';
            }
            if ($key === 4 && $header !== $this->headerKeys[4]) {
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[4] . ' Sesusai Template Upload';
            }
            if ($key === 5 && $header !== $this->headerKeys[5]) {
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[5] . ' Sesusai Template Upload';
            }
            if ($key === 6 && $header !== $this->headerKeys[6]) {
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[6] . ' Sesusai Template Upload';
            }
            if ($key === 7 && $header !== $this->headerKeys[7]) {
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[7] . ' Sesusai Template Upload';
            }
            if ($key === 8 && $header !== $this->headerKeys[8]) {
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[8] . ' Sesusai Template Upload';
            }
            if ($key === 9 && $header !== $this->headerKeys[9]) {
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[9] . ' Sesusai Template Upload';
            }
        }

        return count($message) > 0 ? implode("\n", $message) : null;
    }
}
