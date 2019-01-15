<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMateri;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Materi;
use App\File;
use App\User;

class MateriRakoorController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('materi-rakoor.materi-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materi-rakoor.materi-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMateri $request)
    {
        $materi = new Materi;
        $materi->date = $request->date;
        $materi->agenda_no = $request->agenda_no;
        $materi->username = Auth::user()->username;
        $materi->mulai = $request->jam_mulai;
        $materi->keluar = $request->jam_keluar;
        $materi->judul = $request->judul;
        $materi->no_dokumen = $request->no_dokumen;
        $materi->presenter = $request->presenter;
        $materi->save();
        
        if($request->file && $materi->id){
            foreach ($request->file as $key => $value) {
                $path          = $value->storeAs( 'public/files/'
                                . Auth::user()->username.'/'
                                . $request->tanggal.'/'
                                . $request->agenda, 
                                $value->getClientOriginalName() );
            
                $realName      = $value->getClientOriginalName();

                $file = new File;
                $file->materi_id = $materi->id;
                $file->name = $realName;
                $file->path = $path;
                $file->save();
            }
        }
        return redirect()->route('materi.index');
        
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

        /*
        menampilkan data materi dan data file yang terkait dengan materi.
        di filter berdasarak role : 
            - bukan administrator maka filter berdasrkan colom username 
            pada tabel materis ATAU filter berdasarkan kolom username 
            yang ada pada tabel users (relasi dengan tabel materis)

            - administrator tampilkan semua data materi.
        */
        $materi = Materi::where(function ($query) use ($administrator,$username){
            if(!$administrator){
                $query->where('username',$username)
                ->orWhereHas('users', function ($query) use ($username) {
                    $query->where('username',$username);
                });
            }
        })->with(['files']);

        $ret = datatables($materi)
                ->addColumn('action', 'materi-rakoor._actionBtn')
                ->order(function ($query) {
                    $query->orderBy('date', 'desc');
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
        $materi = Materi::where('id',$id)
            ->with('files')
            ->get();
        return view('materi-rakoor.materi-edit',compact('materi'));
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
        $d = Materi::destroy($id);
        $df = File::where('materi_id', $d)->delete();
        if($d){
            return redirect()->back();
        }
        
    }
}