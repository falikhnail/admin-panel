<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportChannelModel extends Model
{
    use HasFactory;

    protected $table = 'report_channel';

    protected $fillable = [
        'user_id',
        'label_name',
        'channel_name',
        'channel_id',
        'revenue'
    ];
}
