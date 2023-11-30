<?php

use App\Models\Desktop;
use App\Models\DesktopRepair;
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
        Schema::create('desktop_repairs', function (Blueprint $table) {
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

        Schema::create('desktop_desktop_repair', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Desktop::class);
            $table->foreignIdFor(DesktopRepair::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desktop_repairs');
        Schema::dropIfExists('desktop_desktop_repair');
    }
};
