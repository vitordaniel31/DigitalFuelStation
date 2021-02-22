<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombustiveisBombasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combustiveis_bombas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_combustivel');
            $table->foreign('id_combustivel')->references('id')->on('combustiveis');
            $table->unsignedBigInteger('id_bomba');
            $table->foreign('id_bomba')->references('id')->on('bombas');
            $table->boolean('status')->default(0);
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
