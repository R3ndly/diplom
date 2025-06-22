<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->unsignedBigInteger('worker_id', true);
            $table->string('name', 255);
            $table->string('surname', 255);
            $table->string('patronymic', 255);
            $table->unsignedInteger('position_id');
            $table->decimal('salary', 10, 2);
            $table->date('hire_date');
            $table->unsignedTinyInteger('education_id');
            $table->string('phone_number', 255);
            $table->string('email', 255)->unique();

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->foreign('position_id')->references('position_id')->on('positions')->onDelete('restrict');

            $table->foreign('education_id')->references('education_id')->on('education')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->dropForeign(['position_id']);
            $table->dropForeign(['education_id']);
        });

        Schema::dropIfExists('workers');
    }
};
