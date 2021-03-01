<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombustiveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combustiveis', function (Blueprint $table) {
            $table->id();
            $table->string('combustivel')->unique();
            $table->decimal('preco', 5, 3);
            $table->decimal('capacidade', 8, 2);
            $table->decimal('qtd_restante', 8, 2);
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
        Schema::dropIfExists('combustiveis');
    }
}
