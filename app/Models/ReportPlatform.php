<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportPlatform extends BaseModel {
    use HasFactory;

    protected $table = 'report_platform';

    protected $fillable = [
        'users_id',
        'platform_id',
        'platform_imported',
        'artist',
        'revenue',
        'reporting_period',
        'is_release',
        'release_date',
        'created_at',
        'updated_at'
    ];
}
