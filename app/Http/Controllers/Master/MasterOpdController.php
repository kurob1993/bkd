<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterOpd;

class MasterOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('opd.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $masterOpd = MasterOpd::all();
        return view('opd.create',compact('masterOpd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $masterOpd = new MasterOpd();
        $masterOpd->text = $request->post('text');
        $masterOpd->parent_id = $request->post('parent_id');

        if($masterOpd->save()){
            return redirect()->route('opd.index');
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
        $MasterOpd = MasterOpd::all();
        $ret = datatables($MasterOpd)
            ->addColumn('action', 'opd._action')
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
        $masterOpd = MasterOpd::find($id);
        $comboMasterOpd = MasterOpd::all();
        return view('opd.edit',compact('masterOpd','comboMasterOpd'));
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
        $masterOpd = MasterOpd::find($id);
        $masterOpd->text = $request->text;
        $masterOpd->parent_id = $request->parent_id;

        if($masterOpd->save()){
            return redirect()->route('opd.index');
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
        $masterOpd = MasterOpd::destroy($id);
        return redirect()->back();
    }
}
