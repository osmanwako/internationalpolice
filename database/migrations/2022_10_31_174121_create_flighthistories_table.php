<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlighthistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flighthistories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('idno',32);
            $table->string('hotelname')->nullable();
            $table->string('roomno')->nullable();
            $table->date('departdate')->nullable();
            $table->string('flightnum')->nullable();
            $table->string('flighttime')->nullable();
            $table->string('telephone')->nullable();
            $table->string('flighttype')->default('1');
            $table->string('createdby')->nullable();
            $table->string('updatedby')->nullable();
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
        Schema::dropIfExists('flighthistories');
    }
}
