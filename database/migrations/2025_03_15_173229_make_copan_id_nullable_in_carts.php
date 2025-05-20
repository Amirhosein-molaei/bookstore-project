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
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['copan_id']);

            $table->dropColumn('copan_id');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('copan_id')->nullable()->constrained('copans')->onDelete('cascade')->onUpdate('cascade')->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['copan_id']);

            $table->dropColumn('copan_id');

            $table->foreignId('copan_id')->constrained('copans')->onDelete('cascade')->onUpdate('cascade')->after('user_id');
        });
    }
};