<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partisipan extends Model
{
    public function materi_users()
    {
        return $this->belongsTo('App\Materi','App\User');
    }
}
