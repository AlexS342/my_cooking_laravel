<?php

use App\Enums\Recipe\ProductUnits;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->comment('Родитель')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name')->comment('Название продукта');
            $table->integer('quantity')->nullable()->comment('вес, обЪем или количество продукта');
            $table->enum('units', ProductUnits::getEnums())->comment('единицы измерения количества продукта');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
