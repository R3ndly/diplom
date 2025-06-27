<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id('vacancy_id');
            $table->string('title', 255);
            $table->text('description');

            $table->foreignId('department_id')->constrained('departments', 'department_id');
            $table->foreignId('location_id')->constrained('locations', 'location_id');
            $table->foreignId('working_hours_id')->constrained('working_hours', 'working_hours_id');
            $table->foreignId('worker_id')->constrained('workers', 'worker_id');

            $table->decimal('salary', 10, 2)->nullable();
            $table->timestamp('published_at')->useCurrent();

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
