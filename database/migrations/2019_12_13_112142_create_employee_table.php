<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_opd_id');
            $table->integer('employee_status_id');
            $table->integer('position_id');
            $table->string('gelar_depan')->nullable();
            $table->string('nama');
            $table->string('gelar_belakang')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('pendidikan');
            $table->string('jurusan');
            $table->string('no_telepon');
            $table->string('npwp');
            $table->bigInteger('gapok');
            $table->date('tmt');
            $table->string('status_tkk');
            $table->string('keterangan')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
