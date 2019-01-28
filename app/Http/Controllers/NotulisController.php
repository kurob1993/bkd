<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Materi;
use App\Reporter;

class NotulisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $materi = Materi::find($request->id);
        return view('notulis.notulis-create',compact('materi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reporter = Reporter::updateOrCreate(
            [ 'materi_id' => $request->materi_id ],
            [ 'user_id' => $request->user_id ]
        );
        return redirect()->route('partisipan.index');
    }
    public function CountNotulis($user_id)
    {
        $count = reporter::where('user_id',$user_id)->count();
        return $count;
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
        //delete data di tabel reporter sesuai id yang dikirm
        $delete = Reporter::destroy($id);
        return redirect()->route('partisipan.index');
    }
    public function user(Request $request)
    {
        return User::getForSelect2($request);
    }
}
