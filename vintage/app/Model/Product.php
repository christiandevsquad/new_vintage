<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class)
                    ->withTimestamps();
    }
}
