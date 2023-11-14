<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimePokemonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_pokemons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pokemons');
            $table->foreign('id_pokemons')->references('id')->on('pokemons');
            $table->unsignedBigInteger('id_times');
            $table->foreign('id_times')->references('id')->on('times');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_pokemons');
    }
}
