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
        Schema::create('hama_category_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hama_id');
            $table->unsignedBigInteger('hama_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hama_category_pivot');
    }
};
