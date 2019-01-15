<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Materi extends Model
{
    /**
     * Ambil data file dari table materi.
     */
    public function files()
    {
        return $this->hasMany('App\File');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function reporters()
    {
        return $this->hasMany('App\Reporter');
    }
    public function getDmyDateAttribute()
    {
        $date = strtotime($this->date);
        $formatDate = date('d/m/Y',$date);
        return $formatDate;
    }
    public function setDateAttribute($value)
    {
        $var = str_replace('/', '-', $value);
        $tanggal = date('Y-m-d',strtotime($var) );
        $this->attributes['date'] = $tanggal;
    }
    public function scopeGetForSelect2($query,$request)
    {
        /*
        menampilkan data judul materi pada tabel materis.
        di filter berdasarak role : 
            - bukan administrator maka filter berdasrkan colom username 
            pada tabel materis ATAU filter berdasarkan kolom username 
            yang ada pada tabel users (relasi dengan tabel materis)

            - administrator tampilkan semua data materi.
        */

        $administrator = Auth::user()->hasRole('administrator');
        $username = Auth::user()->username;
        $materi = $query->doesntHave('users')
            ->where('judul','like','%'.$request->q.'%')
            ->where(function ($query) use ($administrator,$username){
                if(!$administrator){
                    $query->where('username',$username);
                }
            })
            ->limit(15)
            ->get()
            ->map(function ($value,$key) {
                return ['id' => $value->id, 'text'=>$value->judul.' ( agenda ke : '.$value->agenda_no.' '.$value->date.') '];
            });
        $select2 = ['results'=>$materi];
        return $select2;
    }
}
