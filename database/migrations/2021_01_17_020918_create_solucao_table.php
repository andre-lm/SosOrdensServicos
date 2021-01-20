<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolucaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solucao', function (Blueprint $table) {
            $table->id('id');
            $table->string('requerente');
            $table->string('descricao');
            $table->unsignedBigInteger('ordens_servico_id');
            $table->timestamps();

            $table->foreign('ordens_servico_id')->references('id')->on('os');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solucao');
    }
}
