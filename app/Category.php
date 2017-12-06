<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // $category->products (una categoria tiene muchos productos)
    public function products()
    {
    	return $this->hasMany(Product::class); 
    }
}
