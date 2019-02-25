<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    public function reporters()
    {
        return $this->hasMany('App\Reporter','materi_id');
    }
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
}
