<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
