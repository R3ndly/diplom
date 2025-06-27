<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('working_hours', function (Blueprint $table) {
            $table->id('working_hours_id');
            $table->string('working_hours', 255)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('working_hours');
    }
};
