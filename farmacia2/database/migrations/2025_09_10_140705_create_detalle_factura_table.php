<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detalle_factura', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_factura')->nullable()->constrained('facturas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_producto')->nullable()->constrained('productos')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('cantidad')->nullable();
            $table->decimal('precio_unitario', 10, 2)->nullable();
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('detalle_factura');
    }
};
