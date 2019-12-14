<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function opds()
    {
        return $this->belongsTo('App\Models\MasterOpd','master_opd_id');
    }
}
