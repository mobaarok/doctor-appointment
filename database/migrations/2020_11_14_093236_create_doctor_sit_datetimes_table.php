<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorSitDatetimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_sit_datetimes', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('hospital_id');
            $table->foreign('hospital_id')->references('id')->on('hospitals');
            
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');

            $table->string('bar');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->time('evening_start_time')->nullable();
            $table->time('evening_end_time')->nullable();
            $table->time('day_start_time')->nullable();
            $table->time('day_end_time')->nullable();
            $table->string('shift_type');
            //morning /evening/ / morning-evennig(both) / day
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
        Schema::dropIfExists('doctor_sit_datetimes');
    }
}
