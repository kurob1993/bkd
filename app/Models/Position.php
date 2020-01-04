<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function opd()
    {
        return $this->belongsTo('App\Models\MasterOpd','master_opd_id');
    }

    public function employees()
    {
        return $this->hasOne('App\Models\Employee');
    }
}
