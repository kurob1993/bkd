<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Materi;
use App\MateriUser;
use DataTables;

class PartisipanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('partisipan.partisipan-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $materi = Materi::find($request->id);
        return view('partisipan.partisipan-create',compact('materi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->partisipan as $key => $value) {
            $materi = Materi::find($request->judul);
            if($materi->users()->find($value) == null ){
                $materi->users()->attach($value);
            }
        }
        return redirect()->route('partisipan.index');
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

        $materi = Materi::whereHas('users',function($query) use ($user_id,$administrator){
            if(!$administrator){
                $query->where('user_id',$user_id);
            }
        })->orWhereHas('reporters',function($query) use ($user_id,$administrator){
            if(!$administrator){
                $query->where('user_id',$user_id);
            }
        })->orWhere(function($query) use ($username) {
            $query->where('username',$username);
        })->with(['users','reporters'=>function ($query) {
            $query->with('users');
        }]);

        $ret = datatables($materi)
                ->addColumn('partisipan', 'partisipan._listPartisipan')
                ->addColumn('notulis', 'partisipan._listNotulis')
                ->addColumn('action', 'partisipan._actionBtn')
                ->addColumn('tanggal', function($materi){
                    return $materi->dmyDate;
                })
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
        $materi = Materi::find($id);
        return view('partisipan.partisipan-notulis',compact('materi'));
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
        $materi_user = explode("-",$id);
        $materi = Materi::find($materi_user[0]);
        $materi->users()->detach($materi_user[1]);
        return redirect()->route('partisipan.index');
    }
    public function user(Request $request)
    {
        return User::getForSelect2($request);
    }
}
