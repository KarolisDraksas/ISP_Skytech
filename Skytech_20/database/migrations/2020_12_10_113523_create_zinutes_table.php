<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZinutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zinutes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('fk_rasytojas');
            $table->foreign('fk_rasytojas')->references('id')->on('users');

            $table->unsignedBigInteger('fk_bilietas');
            $table->foreign('fk_bilietas')->references('id')->on('bilietas');

            $table->string('tekstas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zinutes');
    }
}
