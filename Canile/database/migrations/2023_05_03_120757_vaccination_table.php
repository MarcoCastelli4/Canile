<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccination',function(blueprint $table) //per creare una nuova tabella Schema::
        {
            $table->increments('id');   //intero autoincrementale
            $table->string('malattia');
            $table->integer('validità'); //validità in mesi del vaccino
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
    }
};
