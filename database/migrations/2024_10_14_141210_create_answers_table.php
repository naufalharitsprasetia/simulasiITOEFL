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
        Schema::create('answers', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_exam_id')->constrained('user_exams')->onDelete('cascade'); // FK ke tabel user_exams
            $table->string('question_id'); // ID unik atau nomor soal 
            $table->text('answer'); // Jawaban yang diberikan oleh user
            $table->boolean('is_correct'); // Menyimpan apakah jawaban benar atau salah (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
