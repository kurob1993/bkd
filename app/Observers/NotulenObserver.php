<?php

namespace App\Observers;

use App\Notulen;
use App\User;

class NotulenObserver
{
    /**
     * Handle the notulen "created" event.
     *
     * @param  \App\Notulen  $notulen
     * @return void
     */
    public function created(Notulen $notulen)
    {
        $user = User::find($notulen->user_id);
        $user->assignRole('pic');
    }

    /**
     * Handle the notulen "updated" event.
     *
     * @param  \App\Notulen  $notulen
     * @return void
     */
    public function updated(Notulen $notulen)
    {
        $count = Notulen::where('user_id',$notulen->user_id)->count();
        $user = User::find($notulen->user_id);
        if($count == 0){
            $user->removeRole('notulis');
        }else{
            $user->assignRole('pic');
        }
    }

    // before
    public function updating(Reporter $reporter)
    {
        
    }

    /**
     * Handle the notulen "deleted" event.
     *
     * @param  \App\Notulen  $notulen
     * @return void
     */
    public function deleted(Notulen $notulen)
    {
        //
    }

    /**
     * Handle the notulen "restored" event.
     *
     * @param  \App\Notulen  $notulen
     * @return void
     */
    public function restored(Notulen $notulen)
    {
        //
    }

    /**
     * Handle the notulen "force deleted" event.
     *
     * @param  \App\Notulen  $notulen
     * @return void
     */
    public function forceDeleted(Notulen $notulen)
    {
        //
    }
}
