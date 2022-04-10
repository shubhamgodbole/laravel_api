<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PgBooking extends Model
{
        use SoftDeletes;
    function pgDetail() {
        return $this->hasOne('App\Models\Pgdetail', 'id', 'pg_id')->withTrashed();
    }

    function tenantDetail() {
        return $this->hasOne('App\Models\User', 'id', 'tenant_id');
    }
}
