<?php

use App\Models\Desktop;
use App\Models\DesktopOwner;
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
        Schema::create('desktop_owners', function (Blueprint $table) {
            $table->id();
            $table->string('record_type')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->date('record_date');
            $table->string('record_letter')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
        });

        Schema::create('desktop_desktop_owner', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Desktop::class);
            $table->foreignIdFor(DesktopOwner::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desktop_owners');
        Schema::dropIfExists('desktop_desktop_owner');
    }
};
