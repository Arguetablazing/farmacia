<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('etiquetas_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_producto')->nullable()->constrained('productos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('codigo_barras', 50)->nullable();
            $table->dateTime('fecha_generada')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('etiquetas_productos');
    }
};
