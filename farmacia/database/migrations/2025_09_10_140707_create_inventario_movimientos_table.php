<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inventario_movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_producto')->nullable()->constrained('productos')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('tipo_movimiento', ['entrada','salida','devolución','recepción'])->nullable();
            $table->integer('cantidad')->nullable();
            $table->text('motivo')->nullable();
            $table->dateTime('fecha')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignId('id_usuario')->nullable()->constrained('usuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('inventario_movimientos');
    }
};
