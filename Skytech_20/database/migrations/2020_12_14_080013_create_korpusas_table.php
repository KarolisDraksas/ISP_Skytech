<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKorpusasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('korpusas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tipas');
            $table->integer('disku_talpa');
            $table->string('spalva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('korpusas');
    }
}
