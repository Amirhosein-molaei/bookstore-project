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
            // حذف کلید خارجی قبلی
            $table->dropForeign(['copan_id']);

            // حذف ستون copan_id برای تغییر آن
            $table->dropColumn('copan_id');
        });

        Schema::table('carts', function (Blueprint $table) {
            // اضافه کردن مجدد copan_id بعد از user_id
            $table->foreignId('copan_id')->nullable()->constrained('copans')->onDelete('cascade')->onUpdate('cascade')->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // حذف کلید خارجی جدید
            $table->dropForeign(['copan_id']);

            // حذف و بازگردانی copan_id به حالت قبل
            $table->dropColumn('copan_id');

            // اضافه کردن مجدد copan_id بدون nullable
            $table->foreignId('copan_id')->constrained('copans')->onDelete('cascade')->onUpdate('cascade')->after('user_id');
        });
    }
};