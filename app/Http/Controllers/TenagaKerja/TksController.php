<?php

namespace App\Http\Controllers\TenagaKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\MasterOpd;
use PDF;
use Excel;
use App\Exports\EmployeeExport;

class TksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('tks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $MasterOpd = MasterOpd::all();
        return view('tks.create',compact('MasterOpd'));
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

        $emp = new Employee();
        $emp->nama = $request->nama;
        $emp->gelar_depan = $request->gelar_depan;
        $emp->gelar_belakang = $request->gelar_belakang;
        $emp->tempat_lahir = $request->tempat_lahir;
        $emp->tanggal_lahir = $tanggal_lahir;
        $emp->jenis_kelamin = $request->jenis_kelamin;
        $emp->pendidikan = $request->pendidikan;
        $emp->tmt = $tmt;
        $emp->status_tkk = $request->status_tkk;
        $emp->master_opd_id = $request->master_opd_id;
        $emp->employee_status_id = 2;
        $emp->save();

        return redirect()->route('tks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emp = Employee::where('employee_status_id',2)->with(['opds']);

        $ret = datatables($emp)
            ->addColumn('action', 'tks._action')
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
        $masterOpd = MasterOpd::all();
        return view('tks.edit',compact('masterOpd','emp'));
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

        $emp = Employee::find($id);
        $emp->nama = $request->nama;
        $emp->gelar_depan = $request->gelar_depan;
        $emp->gelar_belakang = $request->gelar_belakang;
        $emp->tempat_lahir = $request->tempat_lahir;
        $emp->tanggal_lahir = $tanggal_lahir;
        $emp->jenis_kelamin = $request->jenis_kelamin;
        $emp->pendidikan = $request->pendidikan;
        $emp->tmt = $tmt;
        $emp->status_tkk = $request->status_tkk;
        $emp->master_opd_id = $request->master_opd_id;
        $emp->save();

        return redirect()->route('tks.index');
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

    public function pdf()
    {
        $emp = Employee::all();
        $pdf = PDF::loadview('tks._pdf',compact('emp'));
    	return $pdf->download('laporan-pegawai-pdf.pdf');
    	// return view('tks._pdf',compact('emp'));
    }

    public function excel() 
    {
        return Excel::download(new EmployeeExport, 'invoices.xlsx');
    }
}
