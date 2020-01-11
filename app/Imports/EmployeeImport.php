<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class EmployeeImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) 
        {
            if($key > 0 ){
                $emp = new Employee();
                $emp->master_opd_id      = $row[0] ? $row[0] : 0;
                $emp->employee_status_id = $row[1] ? $row[1] : 0;
                $emp->position_id        = $row[2] ? $row[2] : 0;
                $emp->gelar_depan        = $row[3] ? $row[3] : 0;
                $emp->nama               = $row[4];
                $emp->gelar_belakang     = $row[5];
                $emp->tempat_lahir       = $row[6];
                $emp->tanggal_lahir      = $this->FormatDate($row[7]);
                $emp->jenis_kelamin      = $row[8];
                $emp->pendidikan         = $row[9];
                $emp->jurusan            = $row[10];
                $emp->no_telepon         = $row[11];
                $emp->npwp               = $row[12];
                $emp->gapok              = $row[13];
                $emp->tmt                = $this->FormatDate($row[14]);
                $emp->status_tkk         = $row[15];
                $emp->keterangan         = $row[16];
                $emp->save();
            }
        }
    }
    public function FormatDate($date)
    {
        return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
    }
}
