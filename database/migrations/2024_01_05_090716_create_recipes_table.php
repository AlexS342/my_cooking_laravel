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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('Пользователь, создавший рецепт')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('description')->comment('Небольшое описание блюда')->nullable();
            $table->string('title')->comment('Название рецепта');
            $table->string('full_time')->comment('Примерное время приготовления блюда')->nullable();
            $table->integer('portion')->comment('Количество порций в рецепте')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
