<?php

namespace App\Imports;

use App\Models\PlatformsModel;
use App\Models\ReportChannelModel;
use App\Models\ReportPlatform;
use App\Models\SessionKeyModel;
use App\Models\UserBalanceModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Log;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Session;
use Throwable;


class ChannelReportImport implements ToArray {
    private $userSession;

    private $headerKeys = [
        'no',
        'label_name',
        'channel_name',
        'channel_id',
        'revenue',
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
                    //ignore empty row
                    if (empty($values[1]) && empty($values[2]) && empty($values[3]) && empty($values[4])) {
                        continue;
                    }

                    $isRelease = 0;
                    if (((int)date('j')) >= 10) {
                        $isRelease = 1;
                    }

                    $data = [
                        'users_id' => $this->userIdSelected,
                        'label_name' => $values[1] ?: null,
                        'channel_name' => $values[2] ?: null,
                        'channel_id' => $values[3] ?: null,
                        'revenue' => ((float)$values[4]) ?: null,
                        'reporting_period' => $this->reportingDate,
                        'release_date' => $this->releaseDate(),
                        'is_release' => $isRelease,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];

                    ReportChannelModel::query()->insert($data);

                    //UserBalanceModel::addRevenue($this->userIdSelected, ((float)$values[3]) ?: null, 'import revenue channel');
                }
            }
        } catch (Throwable $e) {
            Log::error('error upload channel  >>>> ' . $e->getMessage());
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
        }

        return count($message) > 0 ? implode("\n", $message) : null;
    }

    private function releaseDate() {
        $firstDayNextMonth = date('Y-m-d', strtotime('+9 days', strtotime('first day of this month')));

        return $firstDayNextMonth;
    }
}
