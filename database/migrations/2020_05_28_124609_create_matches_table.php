<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_one');
            $table->unsignedBigInteger('user_two');
            $table->timestamps();
            $table->foreign('user_one')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_two')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
