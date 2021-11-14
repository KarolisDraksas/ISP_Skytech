<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIsiminimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('isiminimas', function (Blueprint $table) 
        {
            $table -> dropColumn('komentaras');
            $table -> dropColumn('numeris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('isiminimas', function (Blueprint $table) {
              $table -> string('komentaras') ;
              $table -> integer('numeris') ;
        });
    }
}
