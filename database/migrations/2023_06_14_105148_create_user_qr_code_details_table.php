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
        Schema::create('user_qr_code_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title', 255);
            $table->string('UUID', 255)->unique();
            $table->string('type', 15);
            $table->string('resource_type', 30)->nullable();
            $table->text('resource');
            $table->boolean("is_locked");
            $table->string('owner',255);
            $table->string('owner_details',255)->nullable();
            $table->bigInteger('access_count');
            $table->timestamps();
            $table->index(['user_id', 'UUID','type','is_locked','updated_at'],'qr_code_index');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_qr_code_details');
    }
};
