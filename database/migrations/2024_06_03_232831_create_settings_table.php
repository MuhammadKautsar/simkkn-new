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
        // Schema::create('settings', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('level_id')->constrained('level')->onDelete('cascade');
        //     $table->foreignId('feature_id')->constrained('features')->onDelete('cascade');
        //     $table->timestamps();
        // });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('feature_id');
            $table->timestamps();

            $table->foreign('level_id')->references('id')->on('level')->onDelete('cascade');
            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
            $table->unique(['level_id', 'feature_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
