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
        Schema::create('genre_post', function (Blueprint $table) {
            $table->foreignId('genre_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('post_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('genre_post', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
            $table->dropForeign(['post_id']);
            $table->dropIfExists();
        });
    }
};
