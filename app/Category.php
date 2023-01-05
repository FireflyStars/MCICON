<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    /**
     * Get the images for the category.
     */
    public function images()
    {
        return $this->hasMany('App\Image', 'category_id');
    }    
}
