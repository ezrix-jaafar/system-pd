<?php

use App\Models\Phone;
use App\Models\PhoneOwner;
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
        Schema::create('phone_owners', function (Blueprint $table) {
            $table->id();
            $table->string('record_type')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->date('record_date');
            $table->string('record_letter')->nullable();
            $table->unsignedBigInteger('recorder_id');
            $table->foreign('recorder_id')->references('id')->on('users')->cascadeOnDelete();
            $table->longText('note')->nullable();
            $table->timestamps();

        });

        Schema::create('phone_phone_owner', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Phone::class);
            $table->foreignIdFor(PhoneOwner::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_owners');
        Schema::dropIfExists('phone_phone_owner');
    }
};
