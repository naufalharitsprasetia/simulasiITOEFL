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
        Schema::create('user_exams', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // FK ke tabel users
            $table->foreignId('exam_id')->constrained()->onDelete('cascade'); // FK ke tabel exams
            $table->integer('attempt_number'); // Nomor percobaan
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('score')->nullable(); // Nilai ujian (opsional)
            $table->boolean('is_finish')->default(false);
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_exams');
    }
};
