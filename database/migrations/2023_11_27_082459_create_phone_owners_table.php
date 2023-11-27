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
        Schema::create('phone_owners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phone_id');
            $table->foreign('phone_id')->references('id')->on('phones')->cascadeOnDelete();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->date('received_date');
            $table->date('return_date')->nullable();
            $table->string('acceptance_letter')->nullable();
            $table->enum('availability', [
                'Available', 'Not Available'
            ])->default('Not Available');
            $table->longText('note')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_owners');
    }
};
