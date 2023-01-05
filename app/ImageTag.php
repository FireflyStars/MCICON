<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageTag extends Model
{
    /**
     * Get the category that owns the image.
     */
    public function image()
    {
        return $this->belongsTo('App\Image', 'image_id');
    }    
}
