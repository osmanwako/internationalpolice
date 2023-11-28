<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternatpolicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internatpolices', function (Blueprint $table) {
            $table->id();
            $table->string("idno",50)->unique();
            $table->string("title",50);
            $table->string("firstname",20);
            $table->string("secondname",20);
            $table->string("lastname",20);
            $table->string("gender");
            $table->string("email",50)->unique();
            $table->string("profile");
            $table->string("passport");
            $table->string("countrycode");
            $table->string("description");
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
        Schema::dropIfExists('internatpolices');
    }
}
