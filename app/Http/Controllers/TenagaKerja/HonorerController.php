<?php

namespace App\Http\Controllers\TenagaKerja;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeStatus;
use App\Models\MasterOpd;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeesExport;
use App\Imports\EmployeeImport;
use App\Exports\ExampleDataEmployeeExport;

class HonorerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MasterOpd = MasterOpd::all();
        $TipeTk = EmployeeStatus::all();
        return view('honorer.index', compact('MasterOpd','TipeTk') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $MasterOpd = MasterOpd::all();
        $TipeTk = EmployeeStatus::all();
        return view('honorer.create',compact('MasterOpd','TipeTk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));
        $tmt = date('Y-m-d', strtotime($request->tmt));

        $approve = null;
        if($request->employee_status_id == 1 || $request->employee_status_id == 4){
            $approve = 1;
        }

        $emp = new Employee();
        $emp->nama               = $request->nama;
        $emp->gelar_depan        = $request->gelar_depan;
        $emp->gelar_belakang     = $request->gelar_belakang;
        $emp->tempat_lahir       = $request->tempat_lahir;
        $emp->tanggal_lahir      = $tanggal_lahir;
        $emp->jenis_kelamin      = $request->jenis_kelamin;
        $emp->pendidikan         = $request->pendidikan;
        $emp->jurusan            = $request->jurusan;
        $emp->no_telepon         = $request->no_telepon;
        $emp->npwp               = $request->npwp;
        $emp->position_id        = $request->posisi;
        $emp->gapok              = $request->gapok;
        $emp->tmt                = $tmt;
        $emp->status_tkk         = $request->status_tkk;
        $emp->master_opd_id      = $request->master_opd_id;
        $emp->employee_status_id = $request->employee_status_id;
        $emp->stage_id           = $approve;
        $emp->keterangan         = $request->keterangan;
        $emp->save();
        // dd($request);
        return redirect()->route('honorer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if($id == 'all'){
            $emp        = Employee::with(['opds','employeeStatus','position','stage']);
        }

        if ($request->input('stage')) {
            $emp        = Employee::where('stage_id',$request->input('stage'))->with(['opds','employeeStatus','position','stage']);
        }

        $adminSuper = Auth::user()->hasRole('admin super');
        if (!$adminSuper) {
            $opd_id     = Auth::user()->master_opd_id;
            $emp = Employee::with(['opds','employeeStatus','position','stage']);
            $emp->where('master_opd_id',$opd_id);
        }
        

        $ret = datatables($emp)
            ->addColumn('action', 'honorer._action')
            ->editColumn('gapok', 'Rp. {{number_format($gapok,2)}}')
            ->toJson();
        return $ret;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emp = Employee::find($id);
        $MasterOpd = MasterOpd::all();
        $TipeTk = EmployeeStatus::all();
        return view('honorer.edit',compact('MasterOpd','emp','TipeTk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));
        $tmt = date('Y-m-d', strtotime($request->tmt));
        $approve = null;
        if($request->employee_status_id == 1 || $request->employee_status_id == 4){
            $approve = 1;
        }

        $emp = Employee::find($id);
        $emp->nama               = $request->nama;
        $emp->gelar_depan        = $request->gelar_depan;
        $emp->gelar_belakang     = $request->gelar_belakang;
        $emp->tempat_lahir       = $request->tempat_lahir;
        $emp->tanggal_lahir      = $tanggal_lahir;
        $emp->jenis_kelamin      = $request->jenis_kelamin;
        $emp->pendidikan         = $request->pendidikan;
        $emp->jurusan            = $request->jurusan;
        $emp->no_telepon         = $request->no_telepon;
        $emp->npwp               = $request->npwp;
        $emp->position_id        = $request->position_id;
        $emp->gapok              = $request->gapok;
        $emp->tmt                = $tmt;
        $emp->status_tkk         = $request->status_tkk;
        $emp->master_opd_id      = $request->master_opd_id;
        $emp->employee_status_id = $request->employee_status_id;
        $emp->stage_id           = $approve;
        $emp->keterangan         = $request->keterangan;
        $emp->save();

        return redirect()->route('honorer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp = Employee::destroy($id);
        return redirect()->back();
    }

    public function pdf(Request $request)
    {
        $opd        = $request->opd;
        $employee_status_id        = $request->employee_status_id;

        $master_opd = MasterOpd::find($opd);
        $emp        = Employee::where('employee_status_id',$employee_status_id)
                        ->where('master_opd_id',$opd)
                        ->with(['opds','position'])
                        ->get();
        $pdf        = PDF::loadview('honorer._pdf',compact('emp'))->setPaper('a4', 'landscape');;
    	return $pdf->download('laporan-pegawai-pdf-'.$master_opd->text.'.pdf');
    }

    public function excel(Request $request) 
    {
        ob_end_clean();
        ob_start();
        return (new EmployeesExport)->opd($request->opd)->kategori($request->employee_status_id)->download('Tenaga-kerja.xlsx');
    }

    public function import(Request $request) 
    {
        $path1 = $request->file('file')->store('temp'); 
        $path=storage_path('app').'/'.$path1;  
        Excel::import(new EmployeeImport, $path);
        return redirect()->back();
    }

    public function exampleData() 
    {
        return Excel::download(new ExampleDataEmployeeExport, 'Contoh_Data_Tenaga_Kerja.xlsx');
    }

    public function approve(Request $request, $id)
    {
        $emp = Employee::find($id);
        $emp->stage_id = 2;
        $emp->save();

        return redirect()->back();
    }
}
