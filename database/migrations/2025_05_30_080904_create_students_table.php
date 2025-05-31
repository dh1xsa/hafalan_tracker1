<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->string('name');
            $table->string('password');
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->timestamps();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('students', function (Blueprint $table) {
        $table->dropForeign(['group_id']);
        $table->dropForeign(['user_id']);
    });

    Schema::dropIfExists('students');
}

}
