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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Client Name
            $table->string('email'); // Client Email
            $table->string('phone'); // Client Phone
            $table->string('address'); // Client Address
            $table->string('city'); // Client City
            $table->string('state'); // Client State
            $table->string('postcode'); // Client Postcode
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
