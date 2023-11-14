<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreinadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treinadors', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('regiao');
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
        Schema::dropIfExists('treinadors');
    }
}
