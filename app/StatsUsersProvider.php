<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatsUsersProvider extends Model
{
    protected $fillable = ['provider', 'total'];
}
