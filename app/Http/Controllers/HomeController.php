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
        $date = date('Y-m-d');
        $materi = Materi::whereHas('users',function($query) use ($user_id,$date){
            $query->where('user_id',$user_id)
            ->where('materis.date','>=',$date);
        })->orWhereHas('reporters',function($query) use ($user_id,$date){
            $query->where('user_id',$user_id)
            ->where('materis.date','>=',$date);
        })->orWhere(function($query) use ($username,$date,$administrator) {
            if(!$administrator){
                $query->where('username',$username)
                ->where('date','>=',$date);
            }else{
                $query->where('username','<>',$username)
                ->orWhere('username',$username)
                ->where('date','>=',$date);
            }

            $query->where('username',$username)
            ->where('date','>=',$date);
        })->with(['files'])->get();
        // return $materi;
        return view('backdrop.backdrop',compact('materi') );
    }
    public function test(Request $request)
    {
        // return $request->filled('remember');
        dd( Auth::user() );
    }
}
