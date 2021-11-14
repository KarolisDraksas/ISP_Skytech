<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) 
        {
            $table -> string('surname') -> after('name');
            $table-> string('telephone') -> after('surname');
            $table -> string('address') -> after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table -> dropColumn('surname');
            $table -> dropColumn('telephone');
            $table -> dropColumn('address');
        });
    }
}
