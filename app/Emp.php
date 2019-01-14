<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emp extends Model
{
    public function absens()
    {
        return $this->hasMany('App\Absen');
    }
}
