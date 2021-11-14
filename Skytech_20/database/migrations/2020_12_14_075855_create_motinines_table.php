<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotininesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motinines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tipas');
            $table->integer('lizdų_kiekis');
            $table->string('lizdo_tipas');
            $table->string('plėtimo_tipas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motinines');
    }
}
