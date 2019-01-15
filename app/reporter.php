<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reporter extends Model
{
    public function Materis()
    {
        return $this->belongsTo('App\Materi');
    }
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
