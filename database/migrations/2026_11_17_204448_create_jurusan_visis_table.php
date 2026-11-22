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
        Schema::create('jurusan_visis', function (Blueprint $table) {
             $table->uuid('id')->primary();
             $table->foreignuuid('jurusan_id')
                ->constrained('jurusans')
                ->cascadeOnDelete();
             $table->text('visi');
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusan_visis');
    }
};
