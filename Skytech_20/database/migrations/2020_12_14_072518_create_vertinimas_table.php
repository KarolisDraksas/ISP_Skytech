<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVertinimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vertinimas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('vertinimas');
            $table->string('komentaras');

            $table->unsignedBigInteger('fk_vartotojas');
            $table->unsignedBigInteger('fk_preke');
            $table->foreign('fk_vartotojas')->references('id')->on('users');
            $table->foreign('fk_preke')->references('id')->on('prekes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vertinimas');
    }
}
