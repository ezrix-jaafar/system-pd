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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->enum('asset_type', [
                'MobilePhone', 'Laptop', 'Desktop'
            ]);
            $table->string('brand');
            $table->string('model');
            $table->string('ram');
            $table->string('storage');
            $table->string('serial_number');
            $table->date('purchase_date');
            $table->string('purchase_receipt')->nullable();
            $table->date('warranty_expired');
            $table->boolean('is_available')->default(true);
            $table->boolean('is_working')->default(true);
            $table->longText('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
