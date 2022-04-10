<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePgPriceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pg_price_details', function (Blueprint $table) {
            $table->id();
            $table->string('pg_id');
            $table->string('per_day')->nullable();
            $table->string('per_week')->nullable();
            $table->string('per_month')->nullable();
            $table->string('weekend')->nullable();
            $table->string('city_fee')->nullable();
            $table->string('security_deposit')->nullable();
            $table->string('cleaning_fee')->nullable();
            $table->string('tax')->nullable();
            $table->string('extra_guest_fee')->nullable();
            $table->string('discount')->nullable();
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
        Schema::dropIfExists('pg_price_details');
    }
}
