<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
        protected $table = 'ads';
        
        function category()
        {
            return $this->hasOne('App\Models\Category', 'id', 'category_id');
        }
        
        function menu_images()
        {
            return $this->hasOne('App\Models\AdsMenuImage', 'ads_id', 'id');
        }
}
