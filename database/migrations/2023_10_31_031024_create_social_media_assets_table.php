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
        Schema::create('social_media_assets', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->string('platform');
            $table->string('account_type');
            $table->string('account_url');
            $table->string('account_username');
            $table->string('account_password');
            $table->string('account_email')->nullable();
            $table->string('account_phone')->nullable();
            $table->JSON('account_niche')->nullable();
            $table->longText('account_note')->nullable();
            $table->JSON('secret_question')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media_assets');
    }
};
