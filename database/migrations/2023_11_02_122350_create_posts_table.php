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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->string('content');
            $table->char('gender',1);
            $table->foreignId('region_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('views');
            $table->string('contact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropIfExists();
        });

    }
};
