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
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropColumn(['favoriteable_id', 'favoriteable_type']); 
            $table->unsignedBigInteger('favoriteable_id')->after('user_id');
            $table->string('favoriteable_type')->after('favoriteable_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropColumn(['favoriteable_id', 'favoriteable_type']);
        });
    }
};
