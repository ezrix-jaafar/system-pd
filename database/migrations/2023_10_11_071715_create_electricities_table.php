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
        Schema::create('electricities', function (Blueprint $table) {
            $table->id();

            $table->enum('month', [
                'January', 'February', 'March', 'April', 'May', 'June', 'July',
                'August', 'September', 'October', 'November', 'December'
            ]);

            $table->enum('year', [
                '2022', '2023', '2024', '2025', '2026', '2027',
                '2028', '2029', '2030', '2031', '2032', '2033', '2034', '2035'
            ])->nullable();

            $table->decimal('amount', 10, 2);

            $table->string('bill_image')
                ->nullable();

            $table->enum('payment_status', ['unpaid', 'partial', 'paid']);

            $table->date('payment_date')->nullable();

            $table->decimal('paid_amount', 10, 2)->nullable();

            $table->string('payment_slip')
                ->nullable();

            $table->longText('note')
                ->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electricities');
    }
};
