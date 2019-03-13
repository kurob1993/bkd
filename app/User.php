<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable,HasRoles;
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function materis()
    {
        return $this->belongsToMany('App\Materi');
    }

    public function reporters()
    {
        return $this->hasMany('App\Reporter','user_id');
    }

    public function notulens()
    {
        return $this->hasMany('App\Notulen','user_id');
    }

    public function progresses()
    {
        return $this->hasMany('App\Progress','user_id');
    }

    public function scopeGetForSelect2($query,$request)
    {   
        $auth = Auth::user()->username;
        // dapatkan semua username yang mempunyai role administrator
        // dan username user yang login
        $filtterUser = User::select('username')
            ->role('administrator')
            // ->orWhere('username',$auth)
            ->get();
        
        // tampilkan data username dari table users yang role selain administrator
        $user = $query->where(function ($query) use ($filtterUser,$request){
                $query->whereNotIn('username',$filtterUser)
                ->where('name', 'like','%'.$request->q.'%');
            })
            ->limit(15)
            ->get()
            ->map(function ($value,$key) {
                return ['id' => $value->id, 'text'=>$value->name];
            });
        $select2 = ['results'=>$user];
        return $select2;
    }
}
