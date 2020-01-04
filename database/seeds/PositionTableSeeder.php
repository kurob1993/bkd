<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Position;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        
        for ($i=1; $i <= 10 ; $i++) { 
            $Position = new Position();
            $Position->text = $faker->jobTitle;
            $Position->master_opd_id = $faker->numberBetween(10,20);
            $Position->save();
        }
        
    }
}
