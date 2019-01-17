<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Reporter;
use App\User;

class ReporterComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();
        $role = $user->hasRole('administrator');
        if($role){
            $materi = Reporter::take(1);
        }else{
            $materi = Reporter::where('user_id',$user->id)->first();
        }
        
        $view->with(['notulen'=>$materi]);
    }
}