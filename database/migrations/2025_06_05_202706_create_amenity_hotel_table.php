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
        Schema::create('amenity_hotel', function (Blueprint $table) {
            $table->foreignId('hotel_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('amenity_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->primary([
                'hotel_id',
                'amenity_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenity_hotel');
    }
};
