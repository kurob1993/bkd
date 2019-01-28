<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Reporter;
use App\User;

class ReporterObserver
{
    /**
     * Handle the reporter "created" event.
     *
     * @param  \App\Reporter  $reporter
     * @return void
     */

    // after
    public function created(Reporter $reporter)
    {
        $user = User::find($reporter->user_id);
        $user->assignRole('notulis');
    }

    //before
    public function creating(Reporter $reporter)
    {
        
    }

    /**
     * Handle the reporter "updated" event.
     *
     * @param  \App\Reporter  $reporter
     * @return void
     */
    // after
    public function updated(Reporter $reporter)
    {
        $user = User::find($reporter->user_id);
        $user->assignRole('notulis');
    }
    // before
    public function updating(Reporter $reporter)
    {
        $cekdata = reporter::where('materi_id',$reporter->materi_id)->first();
        $count = reporter::where('user_id',$cekdata->user_id)->count();
        if($count == 1){
            $user = User::find($cekdata->user_id);
            $user->removeRole('notulis');
        }
    }

    /**
     * Handle the reporter "deleted" event.
     *
     * @param  \App\Reporter  $reporter
     * @return void
     */
    public function deleted(Reporter $reporter)
    {
        //cek jumlah user_id pada tabel reporters
        $countNotulis = Reporter::where('user_id',$reporter->user_id)->count();

        // jika NOL maka hapus role notulis
        if($countNotulis == 0){
            $user = User::find($reporter->user_id);
            $user->removeRole('notulis');
        }
    }

    /**
     * Handle the reporter "restored" event.
     *
     * @param  \App\Reporter  $reporter
     * @return void
     */
    public function restored(Reporter $reporter)
    {
        //
    }

    /**
     * Handle the reporter "force deleted" event.
     *
     * @param  \App\Reporter  $reporter
     * @return void
     */
    public function forceDeleted(Reporter $reporter)
    {
        //
    }
}
