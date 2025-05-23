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
        Schema::create('kanban_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('column_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('position')->default(0); // Orden dentro de la columna
            $table->boolean('completed')->default(false);
            $table->dateTime('start_date')->nullable(); // Nueva fecha de inicio
            $table->dateTime('due_date')->nullable();  // Fecha límite
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kanban_tasks');
    }
};
