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
        Schema::create('adoption',function(blueprint $table) //per creare una nuova tabella Schema::
        {
            $table->integer('dog_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->date('data');
            
        });
        Schema::table('adoption', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
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
