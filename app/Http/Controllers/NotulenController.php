<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Reporter;
use App\Materi;
use App\User;
use App\Notulen;

class NotulenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notulen.notulen-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $materi = Materi::find($request->id);
        return view('notulen.notulen-create',compact('materi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notulen = new Notulen;
        $notulen->materi_id = $request->materi_id;
        $notulen->start = $request->start;
        $notulen->end = $request->end;
        $notulen->note = $request->note;
        $notulen->user_id = $request->pic;
        $notulen->save();

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
        $administrator = Auth::user()->hasRole('administrator');
        $username = Auth::user()->username;
        $user_id = Auth::user()->id;

        $materi = Materi::whereHas('reporters',function($query) use ($user_id,$administrator){
            $query->where('user_id',$user_id);
        })->orWhere(function($query) use ($username,$administrator) {
            if(!$administrator){
                $query->where('username',$username);
            }else{
                $query->where('username','<>',$username)
                ->orWhere('username',$username);
            }
        })->with(['reporters']);

        // return $materi->get();
        $ret = datatables($materi)
                ->addColumn('action','notulen._action')
                ->addColumn('tanggal', function($materi){
                    return $materi->dmyDate;
                })
                ->toJson();
        return $ret;
    }

    public function viewNotulen($id)
    {
        $notulen = Notulen::where('materi_id',$id)
        ->with(['users']);
        $ret = datatables($notulen)
                ->addColumn('pic',function($notulen){
                    return $notulen->users->name;
                })
                ->toJson();
        return $ret;
    }
    public function view($id)
    {
        return view('notulen.notulen-view',compact('id'));
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
    public function user(Request $request)
    {
        return User::getForSelect2($request);
    }
}
