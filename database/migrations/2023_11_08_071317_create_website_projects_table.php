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
        Schema::create('website_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->enum('project_status', [
                'Domain Pending', 'Domain Locked', 'Domain Purchased', 'Work In Progress', 'Done', 'Cancel'
            ])->default('Domain Pending');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('salesperson_id')->nullable();
            $table->foreign('salesperson_id')->references('id')->on('staff');
            $table->unsignedBigInteger('person_in_charge_id')->nullable();
            $table->foreign('person_in_charge_id')->references('id')->on('staff');
            $table->unsignedBigInteger('coordinator_id')->nullable();
            $table->foreign('coordinator_id')->references('id')->on('staff');
            $table->date('date')->nullable();
            $table->longText('project_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_projects');
    }
};
