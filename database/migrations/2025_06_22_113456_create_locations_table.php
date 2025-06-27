<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id('location_id');
            $table->string('location', 255)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
