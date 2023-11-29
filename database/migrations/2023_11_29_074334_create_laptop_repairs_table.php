<?php

use App\Models\Laptop;
use App\Models\LaptopRepair;
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
        Schema::create('laptop_repairs', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->date('send_date');
            $table->date('pickup_date');
            $table->decimal('repair_cost')->nullable();
            $table->string('send_by');
            $table->string('payment_receipt')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
        });
        Schema::create('laptop_laptop_repair', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Laptop::class);
            $table->foreignIdFor(LaptopRepair::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptop_repairs');
        Schema::dropIfExists('laptop_laptop_repair');
    }
};
