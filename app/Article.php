<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = ['title', 'category_id', 'condition_id', 'user_id', 'description', 'request'];

    public static function boot()
    {
        parent::boot();

        static::saving(function($article) {
            $article->slug = str_slug($article->title);
            $builder = static::whereRaw("slug RLIKE '^{$article->slug}(-[0-9]*)?$'")
                ->latest('id');
            if ($article->id) {
                $builder = $builder->where('id', '<>', $article->id);
            }
            $latestSlug = $builder->value('slug');
            if ($latestSlug) {
                $pieces = explode('-', $latestSlug);
                $number = intval(end($pieces));
                $article->slug .= '-' . ($number + 1);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function offers()
    {
    	return $this->hasMany('App\Offer')->where('parent_id', 0);
    }

    public function questions()
    {
    	return $this->hasMany('App\Question')->where('parent_id', 0);
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function scopeStatus($query, $user_id, $status)
    {
        return $query->with('images')
            ->where([
                'user_id' => $user_id,
                'status'  => $status
            ])->latest();
    }

    public function scopeSearch($query, $q)
    {
        return $query->where('title', 'LIKE', '%' . $q . '%')
            ->orWhere('description', 'LIKE', '%' . $q . '%')
            ->orderBy('created_at', 'desc');
    }
}
