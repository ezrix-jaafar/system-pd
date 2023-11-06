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
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name')->unique();
            $table->date('purchase_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->unsignedBigInteger('hosting_id');
            $table->foreign('hosting_id')->references('id')->on('hostings');
            $table->string('domain_provider')->nullable();
            $table->string('domain_provider_url')->nullable();
            $table->string('domain_provider_username')->nullable();
            $table->string('domain_provider_password')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
