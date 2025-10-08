<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->nullable();
            $table->string('correo', 100)->unique()->nullable();
            $table->string('contraseña', 255)->nullable();
            $table->enum('rol', ['Funcionario', 'Empleado', 'Cajero', 'Administrador', 'Supervisor']);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('usuarios');
    }
};
