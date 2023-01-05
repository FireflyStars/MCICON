<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * Get the category that owns the image.
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    /**
     * Get the images for the category.
     */
    public function tags()
    {
        return $this->hasMany('App\ImageTag', 'image_id');
    }      
}
