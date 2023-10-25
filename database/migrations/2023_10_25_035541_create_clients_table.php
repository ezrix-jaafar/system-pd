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
            $table->string('company')->nullable(); // Client Company
            $table->string('designation')->nullable(); // Client Designation
            $table->longText('address')->nullable(); // Client Address
            $table->string('city')->nullable(); // Client City
            $table->enum('state', [
                'Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan',
                'Pahang', 'Perak', 'Perlis', 'Pulau Pinang', 'Sabah', 'Sarawak', 'Selangor',
                'Terengganu', 'Kuala Lumpur', 'Labuan', 'Putrajaya'
            ]);// Client State
            $table->string('country')->default('Malaysia');
            $table->string('postcode')->nullable(); // Client Postcode
            $table->string('name_card')->nullable(); // Client Name Card
            $table->longText('note')->nullable(); // Client Note
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
