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
        Schema::create('penyakits', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('description');
            $table->string('background_image')->nullable();
            $table->text('penyebab_penyakit')->nullable();
            $table->text('pengendalian')->nullable();
            $table->text('penularan_penyakit')->nullable();
            $table->text('waktu_terjadi_serangan')->nullable();
            $table->string('daerah_persebaran_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyakits');
    }
};
