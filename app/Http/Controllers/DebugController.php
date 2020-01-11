<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterOpd;
use App\Models\Position;
use App\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class DebugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mopd = Employee::take(20)->get();
        $mopd = $mopd->map(function($item, $key){
            return [
                'id'=>$item->id,
                'master_opd_id'=>$item->master_opd_id,
                'employee_status_id'=>$item->employee_status_id,
                'position_id'=>$item->position_id,
                'gelar_depan'=>$item->gelar_depan,
                'nama'=>$item->nama,
                'gelar_belakang'=>$item->gelar_belakang,
                'tempat_lahir'=>$item->tempat_lahir,
                'tanggal_lahir'=>$item->tanggal_lahir->format('Y-m-d'),
                'jenis_kelamin'=>$item->jenis_kelamin,
                'pendidikan'=>$item->pendidikan,
                'jurusan'=>$item->jurusan,
                'no_telepon'=>$item->no_telepon,
                'npwp'=>$item->npwp,
                'gapok'=>$item->gapok,
                'tmt'=>$item->tmt->format('Y-m-d'),
                'status_tkk'=>$item->status_tkk,
                'keterangan'=>$item->keterangan,
                'created_at'=>$item->created_at->format('Y-m-d'),
                'updated_at'=>$item->updated_at->format('Y-m-d')
            ];
        });
        return $mopd;
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
        //
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
