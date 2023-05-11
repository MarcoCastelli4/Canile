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
        Schema::create('dog',function(blueprint $table) //per creare una nuova tabella Schema::
        {
            $table->increments('id');   //intero autoincrementale
            $table->string('nome');
            $table->string('razza');
            $table->string('colore');
            $table->string('lunghezza pelo');
            $table->string('taglia');
            $table->string('sesso');
            $table->date('data nascita');
            $table->bigInteger('user_id')->unsigned()->default(1);
        });

        
        Schema::table('dog', function (Blueprint $table) {
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
