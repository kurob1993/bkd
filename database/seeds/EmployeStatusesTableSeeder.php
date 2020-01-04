<?php

use Illuminate\Database\Seeder;
use App\Models\EmployeeStatus;

class EmployeStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emps = New EmployeeStatus();
        $emps->text = 'TKK';
        $emps->save();

        $emps = New EmployeeStatus();
        $emps->text = 'TKS';
        $emps->save();

        $emps = New EmployeeStatus();
        $emps->text = 'HKL';
        $emps->save();

        $emps = New EmployeeStatus();
        $emps->text = 'K2';
        $emps->save();
    }
}
