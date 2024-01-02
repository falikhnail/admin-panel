<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawModel extends BaseModel {
    use HasFactory;

    protected $table = 'withdraws';

    public $timestamps = false;

    public static function monthlyDashboard() {
        $monthly = function (string $alias, int $month) {
            // * alias eg. last_1_month

            return "(
                        SELECT
                            sum( amount ) AS $alias" . "_wd" . ",
                            IFNULL(MONTHNAME(request_date), MONTHNAME(NOW() - INTERVAL $month MONTH)) as $alias" . "_name" . "
                        FROM
                            withdraws
                        WHERE
                            STATUS = 'approved'
                            AND MONTH (request_date) = MONTH(DATE_SUB(NOW(), INTERVAL $month MONTH))
                            AND YEAR (request_date) = YEAR(DATE_SUB(NOW(), INTERVAL $month MONTH))
                    ) as $alias";
        };

        $sql = "SELECT
                    last_month.*,
                    last_1_month.*,
                    last_2_month.*,
                    last_3_month.*,
                    last_4_month.*,
                    last_5_month.*,
                    last_6_month.*,
                    last_7_month.*,
                    last_8_month.*,
                    last_9_month.*,
                    last_10_month.*,
                    last_11_month.*,
                    last_12_month.*,

                    IFNULL(CAST(((last_month.last_month_wd - last_1_month.last_1_month_wd) / last_month.last_month_wd) * 100 AS DECIMAL(12, 2)), 0.0) as last_month_percentage,
                    IFNULL(CAST(((last_1_month.last_1_month_wd - last_2_month.last_2_month_wd) / last_1_month.last_1_month_wd) * 100 AS DECIMAL(12, 2)), 0.0) as last_1_month_percentage,
                    IFNULL(CAST(((last_2_month.last_2_month_wd - last_3_month.last_3_month_wd) / last_2_month.last_2_month_wd) * 100 AS DECIMAL(12, 2)), 0.0) as last_2_month_percentage,

                    CASE
                WHEN last_month.last_month_wd IS NOT NULL AND last_1_month.last_1_month_wd IS NOT NULL THEN
                    IF(last_month.last_month_wd > last_1_month.last_1_month_wd, 'Increase', 'Decrease')
                ELSE
                    'Static'
                    end as info_last_month,

                    CASE
                            WHEN last_1_month.last_1_month_wd IS NOT NULL AND last_2_month.last_2_month_wd IS NOT NULL THEN
                                    IF(last_1_month.last_1_month_wd > last_2_month.last_2_month_wd, 'Increase', 'Decrease')
                            ELSE
                                    'Static'
                    end as info_last_1_month,

                    CASE
                            WHEN last_2_month.last_2_month_wd IS NOT NULL AND last_3_month.last_3_month_wd IS NOT NULL THEN
                                    IF(last_2_month.last_2_month_wd > last_3_month.last_3_month_wd, 'Increase', 'Decrease')
                            ELSE
                                    'Static'
                    end as info_last_2_month
                FROM
                    (
                        SELECT
                            sum( amount ) AS last_month_wd,
                            MONTHNAME(request_date) as last_month_name
                        FROM
                            withdraws
                        WHERE
                            STATUS = 'approved'
                            AND MONTH(request_date) = MONTH(CURRENT_DATE)
                    ) as last_month,
                    " . $monthly('last_1_month', 1) . ",
                    " . $monthly('last_2_month', 2) . ",
                    " . $monthly('last_3_month', 3) . ",
                    " . $monthly('last_4_month', 4) . ",
                    " . $monthly('last_5_month', 5) . ",
                    " . $monthly('last_6_month', 6) . ",
                    " . $monthly('last_7_month', 7) . ",
                    " . $monthly('last_8_month', 8) . ",
                    " . $monthly('last_9_month', 9) . ",
                    " . $monthly('last_10_month', 10) . ",
                    " . $monthly('last_11_month', 11) . ",
                    " . $monthly('last_12_month', 12) . "
            ";

        $query = DB::select($sql);
        if (count($query) > 0) {
            return $query[0];
        }

        return [];
    }

    public static function invoiceWithdrawsById($id) {
        $sql = "SELECT
                    w1.users_id,
                    w1.`status`,
                    w1.request_date,
                    u1.nama,
                    u1.email,
                    b1.account_name,
                    b1.account_number,
                    b1.bank_name,
                    w1.amount
                FROM
                    withdraws w1
                    JOIN users u1 ON w1.users_id = u1.id
                    LEFT JOIN bank_account b1 on u1.id = b1.users_id
                WHERE w1.id = $id";

        $query = DB::select($sql);
        if (count($query) > 0) {
            return $query[0];
        }

        return [];
    }
}
