<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('hospital_name');
            $table->string('username')->nullable();
            $table->string('mobile_phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->tinyInteger('email_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token')->nullable();
            $table->tinyInteger('is_activated')->default(0);
            $table->timestamp('activated_at')->nullable();

            $table->rememberToken();
            $table->softDeletes();

            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id')->references('id')->on('divisions');


            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');

            $table->unsignedBigInteger('upazila_id')->nullable();
            $table->foreign('upazila_id')->references('id')->on('upazilas');

            $table->string('optional_title')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();
            $table->time('hospital_open_time')->nullable();
            $table->time('hospital_closing_time')->nullable();
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
        Schema::dropIfExists('hospitals');
    }
}
