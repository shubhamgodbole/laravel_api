<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAvailableOnPgdetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pgdetails', function (Blueprint $table) {
            $table->double('latitude')->nullable()->after('size');
            $table->double('longitude')->nullable()->after('latitude'); 
            $table->boolean('is_available')->default(1)->after('longitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pgdetails', function (Blueprint $table) {
            $table->dropColumn('latitude');
            $table->dropColumn('longitude'); 
            $table->dropColumn('is_available'); 
        });
    }
}
