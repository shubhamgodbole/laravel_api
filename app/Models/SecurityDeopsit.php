<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityDeopsit extends Model
{
    function pgDetail() {
        return $this->hasOne('App\Models\Pgdetail', 'id', 'pg_id')->withTrashed();
    }

    function tenantDetail() {
        return $this->hasOne('App\Models\User', 'id', 'tenant_id');
    }
}
