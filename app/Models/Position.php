<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $appends = [
        'parent'
    ];

    public function opd()
    {
        return $this->belongsTo('App\Models\MasterOpd','master_opd_id');
    }

    public function employees()
    {
        return $this->hasOne('App\Models\Employee');
    }

    public function positionChild($id, $arr = [])
    {
        $posisi = Position::where('parent_id',$id)->get();
        foreach ($posisi as $key => $value) {
            $arr = $this->positionChild($value->id,array_merge($arr,[$value->id]));
        }
        return $arr;
    }

    public function getParentAttribute()
    {
        $position = Position::find($this->parent_id);
        return $position['text'];
    }
}
