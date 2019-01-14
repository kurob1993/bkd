<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

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

    public function scopeGetForSelect2($query,$request)
    {
        $user = $query->where('name','like','%'.$request->q.'%')
            ->limit(15)
            ->get()
            ->map(function ($value,$key) {
                return ['id' => $value->id, 'text'=>$value->name];
            });
        $select2 = ['results'=>$user];
        return $select2;
    }
}
