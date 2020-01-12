<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $casts = [
        'tanggal_lahir' => 'date:d-m-Y',
        'tmt' => 'date:d-M-y',
    ];

    protected $appends = [
        'status_tkk_text',
        'jenis_kelamin_text'
    ];

    public function opds()
    {
        return $this->belongsTo('App\Models\MasterOpd','master_opd_id');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\Position');
    }

    public function employeeStatus()
    {
        return $this->belongsTo('App\Models\EmployeeStatus','employee_status_id');
    }

    public function getStatusTkkTextAttribute($value)
    {
        return $this->status_tkk == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    public function getJenisKelaminTextAttribute($value)
    {
        return $this->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan';
    }

    public function scopeTkk($query)
    {
        return $query->where('employee_status_id', 1);
    }

    public function scopeTks($query)
    {
        return $query->where('employee_status_id', 2);
    }

    public function scopeHkl($query)
    {
        return $query->where('employee_status_id', 3);
    }

    public function scopeK2($query)
    {
        return $query->where('employee_status_id', 4);
    }

}
