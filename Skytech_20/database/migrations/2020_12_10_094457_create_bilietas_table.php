<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilietasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilietas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->boolean('aktyvumas')->default(1);
            $table->date('uzdarymas')->nullable();
            $table->string('pavadinimas');
            $table->string('darbuotojo_komentaras')->nullable();
            $table->enum('kategorija', ['Pirkimas', 'Uzsakymai', 'Grazinimas', 'Garantinis', 'Kita'])->default('Kita');

            $table->unsignedBigInteger('fk_vartotojas');
            $table->unsignedBigInteger('fk_darbuotojas');
            $table->foreign('fk_vartotojas')->references('id')->on('users');
            $table->foreign('fk_darbuotojas')->references('id')->on('users');

            $table->date('vertinimo_data')->nullable();
            $table->string('vartotojo_komentaras')->nullable();
            $table->integer('pagalbos_ivertis')->nullable();
            $table->integer('benravimo_ivertis')->nullable();
            $table->integer('`greicio_ivertis`')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bilietas');
    }
}
