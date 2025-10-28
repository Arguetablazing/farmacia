<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('roles_permisos', function (Blueprint $table) {
            $table->id();
            $table->enum('rol', ['Funcionario', 'Empleado', 'Cajero', 'Administrador', 'Supervisor'])->nullable();
            $table->string('funcionalidad', 255)->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('roles_permisos');
    }
};
