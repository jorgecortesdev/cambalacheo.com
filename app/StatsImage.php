<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatsImage extends Model
{
    protected $fillable = ['file_mime', 'total'];
}
