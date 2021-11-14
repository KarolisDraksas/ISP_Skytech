<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrekesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prekes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('kodas');
            $table->string('pavadinimas');
            $table->string('gamintojas');
            $table->string('aprašymas');
            $table->double('kaina');
            $table->integer('kiekis');
            $table->enum('kategorija', ['motinine', 'vaizdo', 'diskas', 'ram', 'procesorius', 'matinimas', 'korpusas']);
            $table->unsignedBigInteger('fk_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prekes');
    }
}
