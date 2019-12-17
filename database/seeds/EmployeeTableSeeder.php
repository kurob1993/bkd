<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Employee;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 100; $i++){
 
            $emp = new Employee;
            $emp->nama = $faker->name;
            $emp->tempat_lahir = $faker->state;
            $emp->tanggal_lahir = $faker->date;
            $emp->jenis_kelamin = $faker->randomElement(['L','P']);
            $emp->pendidikan = $faker->name;
            $emp->tmt = $faker->date;
            $emp->status_tkk = $faker->numberBetween(1,2);
            $emp->master_opd_id = $faker->numberBetween(1,4);
            $emp->save();
 
    	}
    }
}
