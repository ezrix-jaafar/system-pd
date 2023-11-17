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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('training_name');
            $table->string('training_type');
            $table->string('training_provider');
            $table->string('training_location');
            $table->date('training_start_date');
            $table->date('training_end_date');
            $table->decimal('training_fees' , 8, 2);
            $table->longText('training_remarks');
            $table->JSON('training_attendees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
