<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('os', function (Blueprint $table) {
            $table->id('id');
            $table->string('nome_autor');
            $table->string('titulo');
            // $table->string('atribuido_tecnico');
            $table->string('equipamento');
            $table->string('descrição');
            $table->unsignedBigInteger('status_id');
            
            $table->foreign('status_id')->references('id')->on('status');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            
            $table->timestamps();
            $table->softDeletes();
        });
        DB::update("ALTER TABLE os AUTO_INCREMENT = 202101;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('os');
    }

 
}
