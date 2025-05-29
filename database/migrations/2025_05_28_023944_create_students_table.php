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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Kolom relasi ke groups
            $table->unsignedBigInteger('group_id')->nullable(); // Bisa null kalau belum ditentukan grupnya
            $table->string('name');
            $table->string('password');
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']); // L = Laki-laki, P = Perempuan
            $table->timestamps();
            $table->foreign('group_id')
                  ->references('id')
                  ->on('groups')
                  ->onDelete('set null'); // Kalau grup dihapus, student tetap ada tapi group_id jadi null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
