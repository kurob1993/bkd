<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notulen;
use App\User;
use App\Progress;

class ProgresKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('progres-kerja.progres-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $notulen = Notulen::find($id);
        return view('progres-kerja.progres-create',compact('notulen') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $progress = new Progress;
        $progress->notulen_id = $request->notulen_id;
        $progress->proker = $request->proker;
        $progress->user_id = $request->pic;
        $progress->realisasi = $request->realisasi;
        $progress->issue = $request->issue;
        $progress->action_plan = $request->action_plan;
        $progress->save();

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
        $user_id = Auth::user()->id;
        $notulen = Notulen::where('user_id',$user_id)
        ->with(['users']);
        $ret = datatables($notulen)
                ->addColumn('pic',function($notulen){
                    return $notulen->users['name'];
                })
                ->addColumn('progres', function($notulen){
                    $count = $notulen->progress->count() ? $notulen->progress->count() : 1;
                    $sum = $notulen->progress->sum('realisasi') ? $notulen->progress->sum('realisasi') : 0;
                    return  round($sum/$count,2) . ' %';
                })
                ->addColumn('action', 'progres-kerja._actionBtn')
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
        $progress = Progress::where('id',$id)->with('users')->first();
        return view('progres-kerja.progres-edit',compact('progress') );
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
        $progress = Progress::find($id);
        $progress->proker = $request->proker;
        $progress->user_id = $request->pic;
        $progress->realisasi = $request->realisasi;
        $progress->issue = $request->issue;
        $progress->action_plan = $request->action_plan;
        $progress->save();
        return redirect()->route('progres-kerja.create','id='.$request->notulen_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Progress::destroy($id);
        return redirect()->back();
    }

    public function user(Request $request)
    {
        $user = User::getForSelect2($request);
        return $user;
    }

    public function listProker(Request $request)
    {
        $id = $request->id;
        $progress = Progress::where('notulen_id',$id)->with(['users','notulens']);
        $ret = datatables($progress)
        ->addColumn('pic',function($progress){
            return $progress->users['name'];
        })->addColumn('action', 'progres-kerja._actionBtnList')
        ->toJson();
        return $ret;
    }

    public function view($id)
    {
        $notulen = Notulen::find($id);
        return view('progres-kerja.progres-view',compact('notulen'));
    }
}
