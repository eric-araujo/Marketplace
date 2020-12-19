<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'body', 'price','slug'];

    /**
     * Get the options for generating the slug.
     */

    public function getThumbAttribute()
    {
        return $this->photos->first()->image;
    }

    public function setNameAttribute($name)
    {
        $slug = Str::slug($name);
        $matchs = $this->uniqueSlug($slug);

        $this->attributes['name'] = $name;
        $this->attributes['slug'] = $matchs ? $slug . '-' . $matchs : $slug;
    }

    public function uniqueSlug($slug)
    {
        $matchs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();

        return $matchs;
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    } 

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

}
