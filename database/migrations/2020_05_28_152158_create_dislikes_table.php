<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDislikesTable extends Migration
{
    public function up()
    {
        Schema::create('dislikes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_one');
            $table->unsignedBigInteger('user_two');
            $table->foreign('user_one')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_two')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dislikes');
    }
}
