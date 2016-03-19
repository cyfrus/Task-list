<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZadatakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('zadaci', function (Blueprint $table) {
            $table->increments("id")->primary;
            $table->string('naslov');
            $table->text('opis_zadatka');
            $table->boolean('status');
            $table->date('datum_zavrsetka');
            $table->dateTime('vrijeme_otvaranja');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::Drop('zadaci');
    }
}
