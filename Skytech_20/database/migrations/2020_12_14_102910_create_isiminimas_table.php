<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsiminimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isiminimas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('komentaras');
            $table->integer('numeris');

            $table->unsignedBigInteger('fk_user');
            $table->foreign('fk_user')->references('id')->on('users');
            $table->unsignedBigInteger('fk_preke');
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
        Schema::dropIfExists('isiminimas');
    }
}
