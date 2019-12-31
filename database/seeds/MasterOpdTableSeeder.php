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
        
        $masterOpd = new MasterOpd();
        $masterOpd->text = 'WALIKOTA';
        $masterOpd->save();

    	for($i = 1; $i <= 5; $i++){
 
            $masterOpd = new MasterOpd();
            $masterOpd->text = $faker->company;
            $masterOpd->parent_id = 1;
            $masterOpd->save();
        }
        
    	for($i = 1; $i <= 3; $i++){
 
            $masterOpd = new MasterOpd();
            $masterOpd->text = $faker->company;
            $masterOpd->parent_id = 2;
            $masterOpd->save();
        }
        
    	for($i = 1; $i <= 2; $i++){
 
            $masterOpd = new MasterOpd();
            $masterOpd->text = $faker->company;
            $masterOpd->parent_id = 3;
            $masterOpd->save();
        }
        
    	for($i = 1; $i <= 4; $i++){
 
            $masterOpd = new MasterOpd();
            $masterOpd->text = $faker->company;
            $masterOpd->parent_id = 4;
            $masterOpd->save();
        }
        
    	for($i = 1; $i <= 2; $i++){
 
            $masterOpd = new MasterOpd();
            $masterOpd->text = $faker->company;
            $masterOpd->parent_id = 5;
            $masterOpd->save();
    	}
    }
}
