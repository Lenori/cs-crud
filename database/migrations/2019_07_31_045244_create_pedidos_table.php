<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('produto');
            $table->integer('qtd');
            $table->integer('valor');
            $table->string('cliente');
            $table->string('cep');
            $table->string('uf');
            $table->string('municipio');
            $table->string('bairro');
            $table->string('rua');
            $table->string('numero');
            $table->string('despachante');
            $table->integer('status'); // Integer para infinitos status
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
