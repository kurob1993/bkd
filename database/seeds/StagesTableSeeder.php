<?php

use Illuminate\Database\Seeder;
use App\Models\Stage;

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stage = new Stage();
        $stage->text = 'Waiting Approval';
        $stage->save();

        $stage = new Stage();
        $stage->text = 'Approved';
        $stage->save();
    }
}
