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
        Schema::create('ads_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name'); // Project Name
            $table->enum('project_type', [
                'Google Ads', 'Facebook Ads', 'LinkedIn Ads', 'TikTok Ads', 'Shopee Ads'
            ]);
            $table->enum('project_status', [
                'New', 'Active', 'On Hold', 'Ended', 'Renew Active', 'Renew On Hold', 'Renew Ended'
            ])->default('New'); // Project Status
            $table->string('project_link')->nullable(); // Project Link
            $table->string('daily_budget')->nullable(); // Daily Budget
            $table->string('total_spend')->nullable(); // Total spend
            $table->date('start_date')->nullable(); // Start Date
            $table->date('end_date')->nullable(); // End Date
            $table->string('total_days')->nullable(); // Total Days
            $table->longText('project_description')->nullable(); // Project Description
            $table->json('report_image')->nullable(); // Report Image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_projects');
    }
};
