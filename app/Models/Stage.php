<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    public function employees()
    {
        return $this->hasOne('App\Models\Employee');
    }
}
