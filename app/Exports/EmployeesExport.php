<?php

namespace App\Exports;

use App\Models\Employee;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class EmployeesExport implements FromView
{

    use Exportable;

    public function opd(int $opd)
    {
        $this->opd = $opd;
        
        return $this;
    }

    public function kategori(int $kategori)
    {
        $this->kategori = $kategori;
        
        return $this;
    }

    public function view(): View
    {
        return view('honorer.excel', 
            [ 
                'data' => Employee::with(['employeeStatus'])
                        ->where('master_opd_id',$this->opd)
                        ->where('employee_status_id',$this->kategori)
                        ->get() 
            ]
        );
    }
}
