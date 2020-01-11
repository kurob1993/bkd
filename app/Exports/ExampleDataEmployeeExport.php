<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExampleDataEmployeeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $mopd = Employee::take(20)->get();
        $mopd = $mopd->map(function($item, $key){
            return [
                'master_opd_id'=>$item->master_opd_id,
                'employee_status_id'=>$item->employee_status_id,
                'position_id'=>$item->position_id,
                'gelar_depan'=>$item->gelar_depan,
                'nama'=>$item->nama,
                'gelar_belakang'=>$item->gelar_belakang,
                'tempat_lahir'=>$item->tempat_lahir,
                'tanggal_lahir'=>$item->tanggal_lahir->format('d-m-Y'),
                'jenis_kelamin'=>$item->jenis_kelamin,
                'pendidikan'=>$item->pendidikan,
                'jurusan'=>$item->jurusan,
                'no_telepon'=>$item->no_telepon,
                'npwp'=>$item->npwp,
                'gapok'=>$item->gapok,
                'tmt'=>$item->tmt->format('d-m-Y'),
                'status_tkk'=>$item->status_tkk,
                'keterangan'=>$item->keterangan
            ];
        });
        return $mopd;
    }

    public function headings(): array
    {
        return [
            'MASTER_OPD_ID',
            'EMPLOYEE_STATUS_ID',
            'POSITION_ID',
            'GELAR_DEPAN',
            'NAMA',
            'GELAR_BELAKANG',
            'TEMPAT_LAHIR',
            'TANGGAL_LAHIR',
            'JENIS_KELAMIN',
            'PENDIDIKAN',
            'JURUSAN',
            'NO_TELEPON',
            'NPWP',
            'GAPOK',
            'TMT',
            'STATUS_TKK',
            'KETERANGAN',
        ];
    }
}
