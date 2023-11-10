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
        Schema::create('participants', function (Blueprint $table) {
            $table->foreignId('conversation_id')->constrained('conversations')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('role',['admen','member'])->default('member');
            $table->timestamp('joined_at');
            $table->primary(['conversation_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
