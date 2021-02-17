<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombustiveisMaquinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combustiveis_maquinas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_combustivel');
            $table->foreign('id_combustivel')->references('id')->on('combustiveis');
            $table->unsignedBigInteger('id_maquina');
            $table->foreign('id_maquina')->references('id')->on('maquinas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combustiveis_maquinas');
    }
}
