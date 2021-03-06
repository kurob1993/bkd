<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            UserTable::class,
            MasterOpdTableSeeder::class,
            EmployeeTableSeeder::class,
            EmployeStatusesTableSeeder::class,
            StagesTableSeeder::class,
            // PositionTableSeeder::class
        ]);
    }
}
