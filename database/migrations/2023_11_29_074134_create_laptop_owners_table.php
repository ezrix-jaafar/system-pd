<?php

use App\Models\Laptop;
use App\Models\LaptopOwner;
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
        Schema::create('laptop_owners', function (Blueprint $table) {
            $table->id();
            $table->string('record_type')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->date('record_date');
            $table->string('record_letter')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
        });

        Schema::create('laptop_laptop_owner', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Laptop::class);
            $table->foreignIdFor(LaptopOwner::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptop_owners');
        Schema::dropIfExists('laptop_laptop_owner');
    }
};
