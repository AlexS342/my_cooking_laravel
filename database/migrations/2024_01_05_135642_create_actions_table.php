<?php

use App\Enums\Recipe\ActionUnits;
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
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->comment('Родитель')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name')->comment('Конкретное действие по приготовлению');
            $table->integer('quantity')->nullable()->comment('время приготовления');
            $table->enum('units', ActionUnits::getEnums())->comment('единицы измерения время приготовления');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
