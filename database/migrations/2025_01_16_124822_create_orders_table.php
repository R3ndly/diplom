<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity'); // Количество товара
            $table->string('order_status'); // Статус заказа
            $table->text('shipping_address'); // Адрес доставки
            $table->decimal('shipping_cost', 10, 2); // Стоимость доставки
            $table->timestamp('order_date')->useCurrent(); // Дата и время создания заказа
            $table->date('delivery')->nullable(); // Предполагаемая дата доставки
            $table->string('payment_method'); // Способ оплаты
            
            // Внешние ключи
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
