<?php

namespace App\Http\Controllers\Pengguna;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\User;
use App\Role;
use App\Models\MasterOpd;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.user-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $role = Role::all();
        $masterOpd = MasterOpd::all();
        return view('user.user-create',compact('role','masterOpd') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->master_opd_id = $request->opd;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->username = Str::before($request->email, '@');
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole($request->role);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with(['roles','opds']);

        $ret = datatables($user)
            ->addColumn('roles', 'user._listRole')
            ->addColumn('action', 'user._actionBtn')
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
        $user = User::where('id',$id)->with('roles')->first();
        $role = Role::whereNotIn('id',['1','4','5'])->get();
        $masterOpd = MasterOpd::all();
        return view('user.user-edit',compact('user','role','masterOpd'));
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
        $user = User::find($id);
        $user->master_opd_id = $request->opd;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->username = Str::before($request->email, '@');
        $user->save();

        $user->removeRole('admin super');
        $user->removeRole('admin opd');
        $user->assignRole($request->role);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::destroy($id);
        return redirect()->back();
    }
}
