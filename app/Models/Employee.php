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
}
