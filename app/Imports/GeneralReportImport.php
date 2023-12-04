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

    private $headerKeys = [
        'no',
        'platform',
        'label_name',
        'channel_name',
        'artist',
        'album',
        'title',
        'isrc',
        'upc',
        'revenue',
        'quantity',
        'sales_type'
    ];

    public function __construct(
        public string $userIdSelected,
        public string $reportingDate,
        public string $releaseDate = ''
    ) {
        $this->userSession = Session::get(SessionKeyModel::USER_LOGIN);
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
                    if (!empty($values[1])) {
                        $platform = PlatformsModel::whereRaw("name = '$values[1]' or name like '%$values[1]%'")->first();

                        if (!empty($platform)) {
                            $platformId = $platform->id;
                        }
                    }

                    //ignore empty row
                    if (empty($values[1]) || empty($values[2]) || empty($values[3]) || empty($values[4])) {
                        continue;
                    }

                    $isRelease = 0;
                    if (((int)date('j')) >= 10) {
                        $isRelease = 1;
                    }

                    $data = [
                        'users_id' => $this->userIdSelected,
                        'reporting_period' => $this->reportingDate,
                        'platform_id' => $platformId,
                        'label_name' => $values[2] ?: null,
                        'channel_name' => $values[3] ?: null,
                        'artist' => $values[4] ?: null,
                        'album' => $values[5] ?: null,
                        'title' => $values[6] ?: null,
                        'isrc' => $values[7] ?: null,
                        'upc' => $values[8] ?: null,
                        'revenue' => ((float)$values[9]) ?: null,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'is_release' => $isRelease,
                        'release_date' => $this->releaseDate(),
                        'quantity' => $values[10] ?: null,
                        'sales_type' => $values[11] ?: null,
                    ];

                    ReportGeneralModel::query()->insert($data);

                    UserBalanceModel::addRevenue($this->userIdSelected, ((float)$values[9]) ?: null);
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
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[1] . ' Sesusai Template Upload';
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
            if ($key === 11 && $header !== $this->headerKeys[11]) {
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[11] . ' Sesusai Template Upload';
            }
            /* if ($key === 10 && $header !== $this->headerKeys[10]) {
                $message[] = 'Posisikan Cell Header ' . $this->headerKeys[10] . ' Sesusai Template Upload';
            } */
        }

        return count($message) > 0 ? implode("\n", $message) : null;
    }

    private function releaseDate() {
        /* $current_day = (int)date('j');
        if ($current_day < 10) {
            $firstDayNextMonth = date('Y-m-d', strtotime('+9 days', strtotime('first day of this month')));
        } else {
            $firstDayNextMonth = date('Y-m-d', strtotime('+9 days', strtotime('first day of next month')));
        } */

        $firstDayNextMonth = date('Y-m-d', strtotime('+9 days', strtotime('first day of this month')));

        return $firstDayNextMonth;
    }
}
