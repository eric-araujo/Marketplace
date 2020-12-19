<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slug
{
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
}