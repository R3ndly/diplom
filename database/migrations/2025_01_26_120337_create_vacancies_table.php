<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->bigIncrements('vacancy_id');
            $table->string('title');
            $table->text('description');
            $table->string('department');
            $table->string('location');
            $table->string('type')->nullable();
            $table->float('salary')->nullable();
            $table->timestamp('published_at')->useCurrent();
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
