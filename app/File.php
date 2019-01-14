<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * Ambil data materi dari file.
     */
    public function materis()
    {
        return $this->belongsTo('App\Materi');
    }
    /**
     * Ambil nili dari kolom path
     * ganti public jadi storage
     * @param  string  $value
     * @return string
     */
    public function getPathAttribute($value)
    {
        return str_replace_first('public','storage',$value);
    }
}
