<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImportLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimeZone('Asia/Makassar')->format('d-m-Y H:i:s');
    }
}
