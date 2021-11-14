<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUzsakymasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uzsakymas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('numeris');
            $table->double('kaina');
            $table->integer('kiekis');
            $table->enum('kategorija', ['kurjeris', 'paštomatas', 'parduotuve'])->default('parduotuve');
            $table->string('statusas');
            $table->string('sudeliojimas');
            $table->string('adresas');

            $table->unsignedBigInteger('fk_vartotojas');
            $table->unsignedBigInteger('fk_darbuotojas');
            $table->foreign('fk_vartotojas')->references('id')->on('users');
            $table->foreign('fk_darbuotojas')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uzsakymas');
    }
}
