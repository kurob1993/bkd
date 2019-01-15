<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable,HasRoles;

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
    public function scopeGetForSelect2($query,$request)
    {
        // dapatkan semua username yang mempunyai role administrator
        $allUserOfRule = User::select('username')->role('administrator')->get();

        // tampilkan data username dari table users yang role selain administrator
        $user = $query->where(function ($query) use ($allUserOfRule,$request){
                $query->whereNotIn('username',$allUserOfRule)
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
