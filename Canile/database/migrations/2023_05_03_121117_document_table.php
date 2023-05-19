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
        Schema::create('document',function(blueprint $table) //per creare una nuova tabella Schema::
        {
            $table->increments('id');   //intero autoincrementale
            $table->string('titolo');
            $table->string('path');
            $table->integer('dog_id')->unsigned();
        });
        Schema::table('document', function (Blueprint $table) {
            $table->foreign('dog_id')->references('id')->on('dog');
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
