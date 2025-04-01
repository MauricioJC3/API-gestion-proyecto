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
        Schema::create('tasks', function (Blueprint $table){
            $table->id();
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('completed')->default(false);
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->dateTime('start_date')->nullable(); // Fecha de inicio de la tarea
            $table->dateTime('due_date')->nullable(); // Fecha límite de la tarea
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
