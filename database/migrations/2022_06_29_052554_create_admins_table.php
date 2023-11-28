<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("idno",30)->unique();//$table->string('sku',255)->unique();
            $table->string("fullname");
            $table->string("username")->unique();
            $table->string("email")->unique();;
            $table->string("profile");
            $table->boolean("create")->default(false);
            $table->boolean("edit")->default(true);
            $table->boolean("badge")->default(true);
            $table->boolean("delete")->default(false);
            $table->boolean("search")->default(true);
            $table->string("password");
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
        Schema::dropIfExists('admins');
    }
}
