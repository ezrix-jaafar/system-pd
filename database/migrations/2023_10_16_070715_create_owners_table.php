<?php

use App\Models\Asset;
use App\Models\Owner;
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
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('received_date');
            $table->date('return_date')->nullable();
            $table->string('acceptance_letter');
            $table->longText('note')
                ->nullable();
            $table->timestamps();
        });

        Schema::create('asset_owner', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Asset::class);
            $table->foreignIdFor(Owner::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owners');
        Schema::dropIfExists('owners_asset');
    }
};
