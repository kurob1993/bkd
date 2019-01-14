<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    public function emps()
    {
        return $this->belongsTo('App\Emp');
    }
    public function getDateAttribute($value)
    {
        return (int)substr($value,3,2);
    }
    public function getTimeAttribute($value)
    {
        $str = str_replace('.',':',$value);
        $timestamp = strtotime($str);
        $time = date('H:i', $timestamp);

        return $time;
    }
}
