<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Absen;
use App\Emp;
use App\User;
use DataTables;
use App\Materi;
use App\File;
use App\Role;
use App\Reporter;

class DebugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $administrator = Auth::user()->hasRole('administrator');
        // $username = Auth::user()->username;

        // $materi = Materi::where(function ($query) use ($administrator,$username){
        //     if(!$administrator){
        //         $query->where('username',$username)
        //         ->orWhereHas('users', function ($query) use ($username) {
        //             $query->where('username',$username);
        //         });
        //     }
        // })->with(['files']);
        
        // $role = User::role('administrator')->get();
        // dd($role);
        
        // $emp = Emp::with(['absens' => function ($query) {
        //     $query->orderBy('time','desc')
        //         ->groupBy('date','emp_id','inout');
        // }])->get();
        // // dd($emp);
        // return view('absen',compact('emp'));


        // $login = Auth::user()->hasRole('administrator');
        // dd($login);


        $materi = Reporter::find(1);
        return ($materi->name);
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