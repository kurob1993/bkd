<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function notulens()
    {
        return $this->belongsTo('App\Notulen','notulen_id');
    }
}
