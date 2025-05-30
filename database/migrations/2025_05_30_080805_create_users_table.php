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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('level', ['1', '2']); // 1 = admin, 2 = guru
            $table->string('name');
            $table->string('password');
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->unsignedBigInteger('group_id')->nullable(); // Tambahan kolom group_id
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
        });

        Schema::dropIfExists('users');
    }
};
