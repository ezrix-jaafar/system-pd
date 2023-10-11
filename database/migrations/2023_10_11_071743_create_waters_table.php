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
        Schema::create('waters', function (Blueprint $table) {
            $table->id();

            $table->enum('month', [
                'January', 'February', 'March', 'April', 'May', 'June', 'July',
                'August', 'September', 'October', 'November', 'December'
            ]);

            $table->decimal('amount', 10, 2);

            $table->string('bill_image')
                ->nullable();

            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])
                ->default('unpaid');

            $table->date('payment_date')
                ->nullable();

            $table->decimal('paid_amount', 10, 2)
                ->nullable();

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
        Schema::dropIfExists('waters');
    }
};
