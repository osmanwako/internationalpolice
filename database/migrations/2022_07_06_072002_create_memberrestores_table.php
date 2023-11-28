<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberrestoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberrestores', function (Blueprint $table) {
            $table->id();
            $table->integer("regid");
            $table->string("idno");
            $table->string("title");
            $table->string("firstname");
            $table->string("secondname");
            $table->string("lastname");
            $table->string("gender");
            $table->string("email");
            $table->string("profile");
            $table->string("countrycode");
            $table->string("description");
            $table->datetime("createddate");
            $table->string("deletedby");
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
        Schema::dropIfExists('memberrestores');
    }
}
