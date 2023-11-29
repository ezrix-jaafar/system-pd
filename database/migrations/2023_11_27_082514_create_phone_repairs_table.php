<?php

use App\Models\Phone;
use App\Models\PhoneRepair;
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
        Schema::create('phone_repairs', function (Blueprint $table) {
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

        Schema::create('phone_phone_repair', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Phone::class);
            $table->foreignIdFor(PhoneRepair::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_repairs');
        Schema::dropIfExists('phone_phone_repair');
    }
};
