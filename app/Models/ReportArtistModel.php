<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportArtistModel extends BaseModel
{
    use HasFactory;

    protected $table = 'report_artist';

    protected $fillable = [
        'user_id',
        'artist_name',
        'revenue'
    ];
}
