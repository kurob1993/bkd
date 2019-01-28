<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporter extends Model
{    
    protected $fillable = ['user_id','materi_id'];

    public function Materis()
    {
        return $this->belongsTo('App\Materi','materi_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
