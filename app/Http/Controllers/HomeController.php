<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Materi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $administrator = Auth::user()->hasRole('administrator');
        $username = Auth::user()->username;
        $user_id = Auth::user()->id;

        /*
            Menampilkan data materi sesuai username di tabel materis
            atau
            Menampilkan data sesuai user_id pada tabel materi_user
            atau
            Menampilkan data sesuai user_id pada tabel reporters

            sesuai tanggal terahir
        */

        $materi = Materi::whereHas('users',function($query) use ($user_id,$administrator){
            $query->where('user_id',$user_id)
            ->whereHas('materis',function($q) use ($user_id) {
                $lastday = Materi::lastRecodeOfUser($user_id)->first();
                $q->where('date',$lastday['date']);
            });
        })->orWhereHas('reporters',function($query) use ($user_id,$administrator){
            $query->where('user_id',$user_id)
            ->whereHas('materis',function($q) use ($user_id) {
                $lastday = Materi::lastRecodeOfReporter($user_id)->first();
                $q->where('date',$lastday['date']);
            }); 
        })->orWhere(function($query) use ($username) {
            $query->where('username',$username)
            ->where('date',$query->max('date'));
        })->with(['files'])->get();
        return view('backdrop.backdrop',compact('materi') );
    }
    public function test(Request $request)
    {
        // return $request->filled('remember');
        dd( Auth::user() );
    }
}
