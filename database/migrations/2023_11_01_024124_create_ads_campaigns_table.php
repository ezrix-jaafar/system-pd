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
        Schema::create('ads_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_name');
            $table->enum('campaign_platform', [
                'Google Ads', 'Facebook Ads', 'LinkedIn Ads', 'TikTok Ads', 'Shopee Ads'
            ]);
            $table->enum('campaign_status', [
                'New', 'Active', 'On Hold', 'Ended'
            ])->default('New');
            $table->string('campaign_link')->nullable();
            $table->decimal('daily_budget',10,2)->nullable();
            $table->decimal('total_spend',10,2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('total_days')->nullable(); // Total Days
            $table->longText('campaign_description')->nullable(); // Project Description
            $table->json('report_image')->nullable(); // Report Image
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_campaigns');
    }
};
