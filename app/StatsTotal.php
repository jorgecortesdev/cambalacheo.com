<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatsTotal extends Model
{
    protected $fillable = ['table', 'column', 'value', 'total'];
}
