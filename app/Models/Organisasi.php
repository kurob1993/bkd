<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $appends = [
        'parent'
    ];

    public function getParentAttribute()
    {
        $mopd = Organisasi::find($this->parent_id);
        return $mopd['text'];
    }
}
