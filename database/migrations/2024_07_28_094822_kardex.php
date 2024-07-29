<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kardexes', function (Blueprint $table) {
            $table->bigIncrements('idKardex');
            $table->dateTime('fechaKardex');
            $table->string('tipoKardex');
            $table->string('detalleKardex');
            $table->string('estadoKardex');
            $table->string('observacionKardex');
            $table->unsignedBigInteger('idMovimiento');
            $table->foreign('idMovimiento')->references('idMovimiento')->on('movimientos');
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('idUsuario')->on('usuarios');
            $table->double('montoKardex');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Kardex');
    }
};
