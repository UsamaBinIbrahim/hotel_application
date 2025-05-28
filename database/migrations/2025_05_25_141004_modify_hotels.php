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
        Schema::table('hotels', function (Blueprint $table) {
            $table->integer('max_guests')->default(4)->after('available_rooms');
            $table->integer('base_guest_count')->default(2)->after('max_guests');
            $table->double('extra_adult_fee')->default(20)->after('base_guest_count');
            $table->double('extra_child_fee')->default(10)->after('extra_adult_fee');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('max_guests');
            $table->dropColumn('base_guest_count');
            $table->dropColumn('extra_adult_fee');
            $table->dropColumn('extra_child_fee');
        });
    }
};
