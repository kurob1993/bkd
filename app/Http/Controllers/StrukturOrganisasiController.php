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
        // mencari id anak, cucu, cicit dst dari parent yang di cari
        $mopd   = new MasterOpd();
        $opd    = $mopd->opdChild($id,[$id]);

        // Cari organisasi opd berdasarkan id
        $Organisasi = MasterOpd::select('id','text','parent_id')->whereIn('id',$opd)->with('employees')->get();
        $mopd_id = $Organisasi->map(function($item, $key){
            return $item->id;
        });

        // format organisasi opd
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

        // mencari id anak, cucu, cicit dst dari parent yang di cari
        $mposition   = new Position();
        $position    = $mposition->positionChild($id,[$id]);

        // Cari organisasi posisi berdasarkan master position id atau master opd id
        $position   = Position::whereIn('master_opd_id',$opd)->with(['opd','employees'])->get();

        // format organisasi posisi
        $position = $position->map(function($item, $key){
            $parent = $item->parent_id == 0 ?  $item->opd['text'] : $item->parent;

            return [
                [   
                    'v'=>$item->text, 
                    'f'=>$item->text.
                        '<div class="node-style">'.
                        $item->employees['nama'].
                        '</div>'
                ],
                $parent,
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
