<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FavoritePg extends Model
{
    use SoftDeletes;
    function pgFavorite() {
        return $this->hasOne('App\Models\Pgdetail', 'id', 'pg_id');
    }
}
