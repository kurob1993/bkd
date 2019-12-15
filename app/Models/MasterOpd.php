<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterOpd extends Model
{
    protected $appends = [
        'parent'
    ];
    
    public function users()
    {
        return $this->hasMany('App\user','master_opd_id');
    }

    public function employees()
    {
        return $this->hasMany('App\Models\Employee','master_opd_id');
    }

    public function getParentAttribute()
    {
        $mopd = MasterOpd::find($this->parent_id);
        return $mopd['text'];
    }
}
