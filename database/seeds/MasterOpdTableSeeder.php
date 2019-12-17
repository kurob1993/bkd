<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\MasterOpd;

class MasterOpdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 15; $i++){
 
            $masterOpd = new MasterOpd();
            $masterOpd->text = $faker->company;
            $masterOpd->parent_id = $faker->numberBetween(1,10);
            $masterOpd->save();
    	}
    }
}
