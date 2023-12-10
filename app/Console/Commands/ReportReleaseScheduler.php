<?php

namespace App\Console\Commands;

use App\Models\ReportGeneralModel;
use App\Models\ReportPlatform;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReportReleaseScheduler extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduler:release_user_report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'made report release at with release data params on report_general table';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle() {
        $this->proccedGeneral();
        $this->proccedPlatform();
    }

    private function proccedGeneral() {
        $generalData = ReportGeneralModel::query()
            ->whereRaw("release_date = CURRENT_DATE")
            ->whereRaw("(is_release = 0 or is_release is null)")
            ->get();

        if ($generalData->isNotEmpty()) {
            foreach ($generalData as $general) {
                ReportGeneralModel::query()
                    ->where('id', $general->id)
                    ->update([
                        'updated_at' => Carbon::now(),
                        'is_release' => 1
                    ]);
            }
        }
    }

    private function proccedPlatform() {
        $data = ReportPlatform::query()
            ->whereRaw("release_date = CURRENT_DATE")
            ->whereRaw("(is_release = 0 or is_release is null)")
            ->get();

        if ($data->isNotEmpty()) {
            foreach ($data as $platform) {
                ReportGeneralModel::query()
                    ->where('id', $platform->id)
                    ->update([
                        'updated_at' => Carbon::now(),
                        'is_release' => 1
                    ]);
            }
        }
    }
}
