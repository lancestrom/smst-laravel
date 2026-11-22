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
        Schema::create('misi_jurusans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignuuid('jurusan_id')
                ->constrained('jurusans')
                ->cascadeOnDelete();
            $table->text('misi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('misi_jurusans');
    }
};
