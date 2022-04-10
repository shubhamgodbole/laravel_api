<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePgBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pg_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->string('pg_id');
            $table->string('payment_id');
            $table->dateTime('from_date')->nullable();
            $table->dateTime('to_date')->nullable();
            $table->string('extra_guest');
            $table->string('booking_price');
            $table->string('security_deposit');
            $table->string('city_fee');
            $table->string('cleaning_fee');
            $table->string('booking_tax');
            $table->string('extra_guest_fee');
            $table->string('discount');
            $table->string('total_amount');
            $table->string('status');
            $table->boolean('is_actiive')->default(0);
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
        Schema::dropIfExists('pg_bookings');
    }
}
