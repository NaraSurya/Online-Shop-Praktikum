<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    
    public function carts()
    {
        return $this->hasMany('App\cart');
    }
    
    public function product_images()
    {
        return $this->hasMany('App\product_image');
    }

}
