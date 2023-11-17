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
        Schema::create('training_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('staff')->cascadeOnDelete();
            $table->longText('training_report')->nullable();
            $table->json('training_attachment')->nullable();
            $table->timestamps();
        });

        Schema::create('training_report_training', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_report_id')->constrained()->cascadeOnDelete();
            $table->foreignId('training_id')->constrained()->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_reports');
    }
};
