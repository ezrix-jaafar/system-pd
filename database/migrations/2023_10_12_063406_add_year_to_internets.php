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
        Schema::table('internets', function (Blueprint $table) {
            $table->enum('year', [
                '2022', '2023', '2024', '2025', '2026', '2027',
                '2028', '2029', '2030', '2031', '2032', '2033', '2034', '2035'
            ])->after('month')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('internets', function (Blueprint $table) {
            $table->dropColumn('year');
        });
    }
};
