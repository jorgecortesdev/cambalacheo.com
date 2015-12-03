<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FacebookApp extends Model
{
    protected $fillable = ['token'];

    public function getUpdatedAtAttribute($date)
    {
        $date = new Carbon($date);
        return $date->setTimezone('America/Hermosillo');
    }

    public function getCreatedAtAttribute($date)
    {
        $date = new Carbon($date);
        return $date->setTimezone('America/Hermosillo');
    }
}
