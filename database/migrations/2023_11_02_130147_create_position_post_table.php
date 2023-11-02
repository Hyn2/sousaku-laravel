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
        Schema::create('position_post', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('post_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('position_post', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['position_id']);
            $table->dropIfExists();
        });
    }
};
