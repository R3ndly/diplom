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
        Schema::create('workers', function (Blueprint $table) {
            $table->bigIncrements('worker_id');
            $table->string('name');  // Имя работника
            $table->string('surname');  // Фамилия
            $table->string('patronymic');  // Отчество
            $table->text('position');  // Должность
            $table->decimal('salary', 10, 2);  // Зарплата
            $table->date('hire_date');  // Дата приема на работу
            $table->boolean('education');  // Образование
            $table->string('phone_number', 15);  // Номер телефона
            $table->string('email')->unique();  // Email адрес (уникальное поле)
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
