<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use function GuzzleHttp\json_decode;

class MasterOpd extends Model
{
    protected $appends = [
        'parent',
        'total_gaji'
    ];
    
    public function users()
    {
        return $this->hasMany('App\user','master_opd_id');
    }

    public function employees()
    {
        return $this->hasMany('App\Models\Employee','master_opd_id');
    }

    public function position()
    {
        return $this->hasMany('App\Models\Position');
    }

    public function getParentAttribute()
    {
        $mopd = MasterOpd::find($this->parent_id);
        return $mopd['text'];
    }

    public function getTotalGajiAttribute()
    {
        $mopd = Employee::select('gapok')->where('master_opd_id', $this->id)->get();
        return $mopd->sum('gapok');
    }

    public function opd()
    {
        $id = MasterOpd::select('parent_id')->where('parent_id','<>','')->groupBy('parent_id')->get();
        $id = $id->map(function ($item, $key) {
            return $item->parent_id;
        })->all();

        $mopd = MasterOpd::whereIn('id',$id)->get();
        return $mopd;
    }

    public function opdChild($id, $arr = [])
    {
        $mopd = MasterOpd::where('parent_id',$id)->get();
        foreach ($mopd as $key => $value) {
            $arr = $this->opdChild($value->id,array_merge($arr,[$value->id]));
        }
        return $arr;
    }
}
