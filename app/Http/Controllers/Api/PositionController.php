<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Position;

class PositionController extends Controller
{
    public function positionByOpd(Request $request)
    {
        $opd_id = $request->opd_id;
        $posisi = Position::where('master_opd_id',$opd_id)->get();
        return $posisi;
    }
}
