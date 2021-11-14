<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrekesUzsakymasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prekes_uzsakymas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('kiekis');
            $table->unsignedBigInteger('fk_preke');
            $table->unsignedBigInteger('fk_uzsakymas');
            $table->foreign('fk_preke')->references('id')->on('prekes');
            $table->foreign('fk_uzsakymas')->references('id')->on('uzsakymas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prekes_uzsakymas');
    }
}
