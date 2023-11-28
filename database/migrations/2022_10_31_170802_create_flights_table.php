<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
    * hotelname roomno departdate flightnum flighttime telephone
     * 
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('idno',32)->unique();
            $table->string('hotelname')->nullable();
            $table->string('roomno')->nullable();
            $table->date('departdate')->nullable();
            $table->string('flightnum')->nullable();
            $table->string('flighttime')->nullable();
            $table->string('telephone')->nullable();
            $table->string('flighttype')->default('1');
            $table->string('credential')->nullable();
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
        Schema::dropIfExists('flights');
    }
}
