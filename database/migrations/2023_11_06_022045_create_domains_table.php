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
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('hosting_id');
            $table->foreign('hosting_id')->references('id')->on('hostings');
            $table->unsignedBigInteger('domain_registrar_id');
            $table->foreign('domain_registrar_id')->references('id')->on('domain_registrars');
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
