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
        Schema::create('review',function(blueprint $table) //per creare una nuova tabella Schema::
        {
            $table->increments('id');   //intero autoincrementale
            $table->string('titolo');
            $table->string('contenuto');
            $table->date('data');
            $table->integer('valutazione');
            $table->bigInteger('user_id')->unsigned()->default(1);
        });
        Schema::table('review', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
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
