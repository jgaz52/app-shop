<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // $product->category (pemite conocer la categoria de un producto determinado)
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    // $product->images
    public function images()
    {
    	return $this->hasMany(ProductImage::class);
    }

    //imagen destacada
    public function getFeaturedImageUrlAttribute()
    {
        $featuredImage = $this->images()->where('featured', true)->first();
        if (!$featuredImage) {
            $featuredImage = $this->images()->first();
        }

        if ($featuredImage) {
            return $featuredImage->url;
        }

        // default 
        return '/images/products/default.png';
    }
}
