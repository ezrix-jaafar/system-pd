<?php

use App\Models\AssetHolder;
use App\Models\SocialMediaAsset;
use App\Models\Staff;
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
        Schema::create('asset_holders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->date('received_date');
            $table->date('return_date')->nullable();
            $table->string('acceptance_letter')->nullable();
            $table->longText('note')
                ->nullable();
            $table->timestamps();
        });

        Schema::create('asset_holder_social_media_asset', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SocialMediaAsset::class);
            $table->foreignIdFor(AssetHolder::class);
        });

        Schema::create('asset_holder_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Staff::class);
            $table->foreignIdFor(AssetHolder::class);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_holders');
        Schema::dropIfExists('asset_holder_social_media_asset');
        Schema::dropIfExists('asset_holder_staff');
    }
};
