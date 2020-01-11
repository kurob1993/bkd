<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterOpd;
use App\Models\Position;

class MasterPosisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posisi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $masterOpd = MasterOpd::all();
        return view('posisi.create',compact('masterOpd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parent = $request->input('parent_id');
        $posisi = new Position();
        $posisi->text = $request->input('posisi');
        $posisi->parent_id = $request->input('parent_posisi');
        $posisi->master_opd_id = $request->input('master_opd_id');

        if($posisi->save()){
            return redirect()->route('posisi.index');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posisi = Position::with(['opd']);
        $ret = datatables($posisi)
            ->addColumn('action', 'posisi._action')
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
        $posisi = Position::find($id);
        $comboMasterOpd = MasterOpd::all();
        return view('posisi.edit',compact('posisi','comboMasterOpd'));
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
        $posisi = Position::find($id);
        $posisi->text = $request->posisi;
        $posisi->parent_id = $request->parent_posisi;
        $posisi->master_opd_id = $request->master_opd_id;

        if($posisi->save()){
            return redirect()->route('posisi.index');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posisi = Position::destroy($id);
        return redirect()->back();
    }
}
