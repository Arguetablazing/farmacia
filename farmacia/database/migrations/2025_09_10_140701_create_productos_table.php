<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('categoria', 50)->nullable();
            $table->string('proveedor', 100)->nullable();
            $table->string('unidad_medida', 20)->nullable();
            $table->decimal('precio_compra', 10, 2)->nullable();
            $table->decimal('precio_venta', 10, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('productos');
    }
};
