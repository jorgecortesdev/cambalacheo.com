<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['article_id', 'file_size', 'file_mime', 'user_id'];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
