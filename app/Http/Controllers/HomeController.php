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
        $materi = Materi::where(function ($query) {
            $last = $query->orderBy('date','desc')->first();
            $last = $last?$last->date:'';
            $query->where('date', $last);
        })
        ->with('files')
        ->get();
        return view('backdrop.backdrop',compact('materi') );
    }
    public function test(Request $request)
    {
        // return $request->filled('remember');
        dd( Auth::user() );
    }
}
