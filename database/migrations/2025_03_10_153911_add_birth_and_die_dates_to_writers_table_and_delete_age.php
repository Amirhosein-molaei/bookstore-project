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
        Schema::table('writers', function (Blueprint $table) {
            $table->dropColumn('age');
            $table->string('english_name')->nullable()->after('name');
            $table->integer('birth_year')->nullable()->after('nationality');
            $table->integer('death_year')->nullable()->after('birth_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('writers', function (Blueprint $table) {
            //
        });
    }
};
