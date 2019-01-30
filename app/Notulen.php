<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function setStartAttribute($value)
    {
        $var = str_replace('/', '-', $value);
        $tanggal = date('Y-m-d',strtotime($var) );
        $this->attributes['start'] = $tanggal;
    }

    public function setEndAttribute($value)
    {
        $var = str_replace('/', '-', $value);
        $tanggal = date('Y-m-d',strtotime($var) );
        $this->attributes['end'] = $tanggal;
    }
}
