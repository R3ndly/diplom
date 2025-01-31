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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->bigIncrements('vacancy_id'); // Уникальный идентификатор вакансии
            $table->string('title'); // Название вакансии
            $table->text('description'); // Описание вакансии
            $table->string('department'); // Отдел, в котором открывается вакансия
            $table->string('location'); // Место работы (город или офис)
            $table->string('type')->nullable(); // Тип работы (полный день, частичная занятость)
            $table->float('salary')->nullable(); // Зарплата
            $table->timestamp('published_at')->useCurrent(); // Дата публикации вакансии
            $table->string('contact_email'); // Email для обратной связи
            $table->string('contact_phone')->nullable(); // Телефон для обратной связи
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
