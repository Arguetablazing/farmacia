<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->nullable()->constrained('clientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_usuario')->nullable()->constrained('usuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('fecha')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('total', 10, 2)->nullable();
            $table->boolean('enviada_por_correo')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('facturas');
    }
};
