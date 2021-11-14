<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesoriusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procesoriuses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->double('greitis');
            $table->integer('branduoliu_skaicius');
            $table->integer('tikros_gijos');
            $table->integer('giju_skaicius');
            $table->string('lizdo_tipas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procesoriuses');
    }
}
