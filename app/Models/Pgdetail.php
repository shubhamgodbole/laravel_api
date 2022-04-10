<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Pgdetail extends Model
{
    use SoftDeletes;
    function address()
    {
        return $this->hasOne('App\Models\Address', 'id', 'address_id');
    }

    function pg_images()
    {
        return $this->hasMany('App\Models\PgImage', 'pg_id', 'id');
    }

    function pg_owner() {
        return $this->hasOne('App\Models\User', 'id', 'owner_id');
    }

    function pg_propertyType() {
        return $this->hasOne('App\Models\PropertyType', 'id', 'property_type_id');
    }

    function pg_roomType() {
        return $this->hasOne('App\Models\RoomType', 'id', 'room_type_id');
    }

    function pg_amenities() {
        return $this->hasMany('App\Models\PgAmenitie', 'pg_id', 'id');
    }

    function pg_pricing() {
        return $this->hasOne('App\Models\PgPriceDetail', 'pg_id', 'id');
    }
    
    function favorite_pg() {
        return $this->hasOne('App\Models\FavoritePg', 'pg_id', 'id');
    }
}
