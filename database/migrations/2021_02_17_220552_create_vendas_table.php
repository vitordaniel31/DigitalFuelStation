<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bomba');
            $table->foreign('id_bomba')->references('id')->on('bombas');
            $table->unsignedBigInteger('id_combustivel');
            $table->foreign('id_combustivel')->references('id')->on('combustiveis');
            $table->decimal('litros_comprados', 8, 2);
            $table->decimal('valor', 8, 2);
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
        Schema::dropIfExists('vendas');
    }
}
