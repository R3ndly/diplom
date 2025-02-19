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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_id'); // Уникальный идентификатор продукта
            $table->string('title'); // Название продукта
            $table->decimal('price', 10, 2); // Цена продукта
            $table->string('brand'); // Установите уникальный индекс
            $table->date('delivery'); // Дата доставки
            $table->string('category'); // Категория продукта
            $table->string('warranty'); // Гарантия
            $table->string('material'); // Материал продукта
            $table->string('power_supply'); // Питание
            $table->string('product_image'); // Изображение продукта
        
            // Индекс для поля brand (необязательно, если оно уже уникальное)
            //$table->index('brand'); 
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
