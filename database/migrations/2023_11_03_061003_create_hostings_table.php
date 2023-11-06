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
        Schema::create('hostings', function (Blueprint $table) {
            $table->id();
            $table->string('server_name');
            $table->string('domain_name')->unique();
            $table->string('package_name');
            $table->decimal('server_cost' , 8, 2);
            $table->date('purchase_date');
            $table->date('expiry_date');
            $table->unsignedBigInteger('hosting_provider_id');
            $table->foreign('hosting_provider_id')->references('id')->on('hosting_providers');
            $table->string('client_dashboard_url');
            $table->string('dashboard_username');
            $table->string('dashboard_password');
            $table->string('cpanel_url');
            $table->string('cpanel_username');
            $table->string('cpanel_password');
            $table->string('nameserver_1');
            $table->string('nameserver_2');
            $table->string('ip_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostings');
    }
};
