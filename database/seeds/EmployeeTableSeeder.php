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
 
    	for($i = 1; $i <= 50; $i++){
 
            $emp = new Employee;
            $emp->nama                  = $faker->name;
            $emp->tempat_lahir          = $faker->state;
            $emp->tanggal_lahir         = $faker->date;
            $emp->jenis_kelamin         = $faker->randomElement(['L','P']);
            $emp->pendidikan            = $faker->randomElement(['S3','S2','S1','D4','D3','D2','D1','SMA','SMP','SD']);
            $emp->jurusan               = $faker->jobTitle;
            $emp->npwp                  = $faker->creditCardNumber;
            $emp->no_telepon            = $faker->phoneNumber;
            $emp->gapok                 = $faker->numberBetween(1000000,10000000);
            $emp->tmt                   = $faker->date;
            $emp->status_tkk            = $faker->numberBetween(1,2);
            $emp->master_opd_id         = $faker->numberBetween(1,60);
            $emp->employee_status_id    = $faker->numberBetween(1,4);
            $emp->keterangan            = $faker->sentence(3);
            $emp->save();
 
        }
        for($i = 1; $i <= 50; $i++){
 
            $emp = new Employee;
            $emp->nama                  = $faker->name;
            $emp->tempat_lahir          = $faker->state;
            $emp->tanggal_lahir         = $faker->date;
            $emp->jenis_kelamin         = $faker->randomElement(['L','P']);
            $emp->pendidikan            = $faker->randomElement(['S3','S2','S1','D4','D3','D2','D1','SMA','SMP','SD']);
            $emp->jurusan               = $faker->jobTitle;
            $emp->npwp                  = $faker->creditCardNumber;
            $emp->no_telepon            = $faker->phoneNumber;
            $emp->gapok                 = $faker->numberBetween(1000000,10000000);
            $emp->tmt                   = $faker->date;
            $emp->status_tkk            = $faker->numberBetween(1,2);
            $emp->master_opd_id         = $faker->numberBetween(1,60);
            $emp->employee_status_id    = $faker->numberBetween(1,4);
            $emp->position_id           = $i;
            $emp->keterangan            = $faker->sentence(3);
            $emp->save();
 
    	}
    }
}
