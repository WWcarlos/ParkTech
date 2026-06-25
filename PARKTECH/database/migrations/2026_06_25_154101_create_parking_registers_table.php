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
        Schema::create('parking_registers', function (Blueprint $table) {
            $table->id('id_registro');
            $table->foreignId('id_vehiculo')->constrained('vehicles', 'id_vehiculo')->onDelete('cascade');
            $table->foreignId('id_space')->constrained('spaces', 'id_space')->onDelete('cascade');
            $table->foreignId('id_tarifa')->constrained('tariffs', 'id_tarifa')->onDelete('cascade');
            
            $table->dateTime('fecha_hora_entrada');
            $table->dateTime('fecha_hora_salida')->nullable();
            $table->decimal('tiempo_total', 8, 2)->nullable();
            $table->decimal('valor_pagado', 8, 2)->nullable();
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_registers');
    }
};
