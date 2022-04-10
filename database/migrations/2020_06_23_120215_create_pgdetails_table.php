<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePgdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pgdetails', function (Blueprint $table) {
            $table->id();
            $table->string('owner_id');
            $table->string('pg_name');
            $table->string('property_type_id');
            $table->string('room_type_id');
            $table->string('booking_type_id');
            $table->string('address_id');
            $table->string('min_members')->nullable();
            $table->string('max_members')->nullable();
            $table->string('size')->nullable();
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('pgdetails');
    }
}
