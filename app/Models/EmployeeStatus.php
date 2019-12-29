<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
    public function employees()
    {
        return $this->hasMany('App\Models\Employee','employee_status_id');
    }
}
