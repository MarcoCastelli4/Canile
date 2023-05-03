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
         /**Creo tabella pivot */
         Schema::create('dog_vaccination',function(blueprint $table){
            $table->integer('dog_id')->unsigned();   
            $table->integer('vaccination_id')->unsigned();
            $table->date('data');

            /**Fisso il vincolo di chiave esterna */
            $table->foreign('dog_id')->references('id')->on('dog');
            $table->foreign('vaccination_id')->references('id')->on('vaccination');
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
