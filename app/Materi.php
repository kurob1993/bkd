<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    /**
     * Ambil data file dari table materi.
     */
    public function files()
    {
        return $this->hasMany('App\File');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    // public function getDateAttribute($value)
    // {
    //     $date = strtotime($value);
    //     $formatDate = date('d/m/Y',$date);
    //     return $formatDate;
    // }
    public function getDmyDateAttribute()
    {
        $date = strtotime($this->date);
        $formatDate = date('d/m/Y',$date);
        return $formatDate;
    }

    public function setDateAttribute($value)
    {
        $var = str_replace('/', '-', $value);
        $tanggal = date('Y-m-d',strtotime($var) );
        $this->attributes['date'] = $tanggal;
    }
    public function scopeGetForSelect2($query,$request)
    {
        $materi = $query->where('judul','like','%'.$request->q.'%')
            ->limit(15)
            ->get()
            ->map(function ($value,$key) {
                return ['id' => $value->id, 'text'=>$value->judul];
            });
        $select2 = ['results'=>$materi];
        return $select2;
    }
}
