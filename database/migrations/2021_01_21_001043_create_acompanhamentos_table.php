<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcompanhamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acompanhamentos', function (Blueprint $table) {
            $table->id('id');
            $table->string('requerente')->nullable();
            $table->string('descricao');
            $table->unsignedBigInteger('ordens_servico_id');
            
            $table->integer('id_user')->unsigned()->nullable();;
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('ordens_servico_id')->references('id')->on('os');
            
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
        Schema::dropIfExists('acompanhamentos');
    }
}
