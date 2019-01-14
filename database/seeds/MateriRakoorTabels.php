<?php

use Illuminate\Database\Seeder;
use App\materi;
use App\file;

class MateriRakoorTabels extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materi = new Materi;
        $materi->date = date('Y-m-d');
        $materi->agenda_no = 1;
        $materi->username = 'admin';
        $materi->mulai = '08:00';
        $materi->keluar = '10;00';
        $materi->judul = 'Test rakoor';
        $materi->no_dokumen = 'NO/Rakoor/112';
        $materi->presenter = 'Admin';
        $materi->save();

        $file = new File;
        $file->materi_id = $materi->id;
        $file->name = str_random(10);
        $file->path = str_random(100).'.pdf';
        $file->save();

        $file = new File;
        $file->materi_id = $materi->id;
        $file->name = str_random(10);
        $file->path = str_random(100).'.pdf';
        $file->save();
    }
}
