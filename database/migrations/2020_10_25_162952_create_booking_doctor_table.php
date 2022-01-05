<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_doctor', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->integer('serial_number');
    
            $table->unsignedBigInteger('hospital_id');
            $table->foreign('hospital_id')->references('id')->on('hospitals');
            
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');


            $table->string('patient_name');
            $table->string('patient_age')->nullable();
            $table->string('patient_phone');
            $table->string('booking_date');
            $table->string('booking_hours')->nullable();
            $table->tinyInteger('is_complete')->default(0)->nullable();
            $table->tinyInteger('serial_type')->default(1)->nullable(); //1 = online, 0 = local
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
        Schema::dropIfExists('booking_doctor');
    }
}
