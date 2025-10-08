<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('copias_seguridad', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('ruta_archivo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('copias_seguridad');
    }
};
