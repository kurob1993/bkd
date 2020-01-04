<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use App\Models\MasterOpd;
use App\Models\Position;

class StrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mopd = MasterOpd::all();
        return view('struktur-organisasi.index', compact('mopd') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mopd = new MasterOpd;
        $opd = $mopd->opdChild($id,[$id]);
        
        $Organisasi = MasterOpd::select('id','text','parent_id')->whereIn('id',$opd)->with('employees')->get();
        $mopd_id = $Organisasi->map(function($item, $key){
            return $item->id;
        });
        $position   = Position::whereIn('master_opd_id',$mopd_id)->with(['opd','employees'])->get();

        $Organisasi = $Organisasi->map(function($item, $key){
            return [
                [   
                    'v'=>$item->text, 
                    'f'=>$item->text.
                        '<div class="node-style">'.
                        $item->employees->where('position_id','0')->first()['nama'].
                        '</div>'
                ],
                $item->parent,
                (string)$item->id
            ];
        });

        $position = $position->map(function($item, $key){
            return [
                [   
                    'v'=>$item->text, 
                    'f'=>$item->text.
                        '<div class="node-style">'.
                        $item->employees['nama'].
                        '</div>'
                ],
                $item->opd['text'],
                (string)$item->id
            ];
        });

        return $Organisasi->merge($position);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
