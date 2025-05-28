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
            $table->enum('level', ['1', '2']);
            $table->string('name');
            $table->string('password');
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->unsignedBigInteger('group_id')->nullable();
            $table->timestamps();
            $table->foreign('group_id')->references('id')->on('groups')->nullOnDelete(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
