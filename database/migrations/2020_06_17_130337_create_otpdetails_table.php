<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otpdetails', function (Blueprint $table) {
            $table->id();
            $table->string('mobile');
            $table->string('request_type')->nullable()->default("registration");
            $table->string('otp');
            $table->boolean('is_verified')->default(0);
            $table->dateTime("verification_datetime")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otpdetails');
    }
}
