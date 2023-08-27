<?php

namespace App\Imports;

use App\Models\PlatformsModel;
use App\Models\ReportGeneralModel;
use App\Models\SessionKeyModel;
use App\Models\UserBalanceModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Log;
use Maatwebsite\Excel\Concerns\ToArray;
use Session;
use Throwable;

class GeneralReportImport implements ToArray {

    private $userSession;
    private $userIdSelected;

    private $headerKeys = [
        'no',
        'reporting_period',
        'platform',
        'label_name',
        'channel_name',
        'artist',
        'album',
        'title',
        'isrc',
        'upc',
        'revenue',
    ];

    public function __construct($userIdSelected) {
        $this->userSession = Session::get(SessionKeyModel::USER_LOGIN);
        $this->userIdSelected = $userIdSelected;
    }

    /**
     * @param array $array
     */
    public function array(array $array) {
        try {
            foreach ($array as $key => $values) {
                if ($key === 0) {
                    $validate = $this->validateHeaderWithRowNumber($array[0]);
                    if (!empty($validate)) {
                        throw new Exception($validate);
                    }
                } else {
                    $platformId = 0;
                    if (!empty($values[2])) {
                        $platform = PlatformsModel::whereRaw("name = '$values[2]' or name like '%$values[2]%'")->first();

                        if (!empty($platform)) {
                            $platformId = $platform->id;
                        }
                    }

                    //ignore empty row
                    if (empty($values[1]) || empty($values[2]) || empty($values[3]) || empty($values[4])) {
                        continue;
                    }

                    $reportingPeriod = !empty($values[1]) ? date('Y-m-d', strtotime($values[1])) : null;
                    $revenue = (float)$values[10];

                    $data = [
                        'users_id' => $this->userIdSelected,
                        'reporting_period' => $reportingPeriod,
                        'platform_id' => $platformId,
                        'label_name' => $values[3] ?: null,
                        'channel_name' => $values[4] ?: null,
                        'artist' => $values[5] ?: null,
                        'album' => $values[6] ?: null,
                        'title' => $values[7] ?: null,
                        'isrc' => $values[8] ?: null,
                        'upc' => $values[9] ?: null,
                        'revenue' => $revenue  ?: null,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];

                    ReportGeneralModel::query()->insert($data);

                    UserBalanceModel::addRevenue($this->userIdSelected, $revenue);
                }
            }
        } catch (Throwable $e) {
            Log::error('error upload general  >>>> ' . $e->getMessage());
            abort('500', 'Make sure file to upload is similiar with template');
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
            if ($key === 10 && $header !== $this->headerKeys[10]) {
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[10] . ' Sesusai Template Upload';
            }
        }

        return count($message) > 0 ? implode("\n", $message) : null;
    }
}
