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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('copan_id')->nullable()->constrained('copans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade')->onUpdate('cascade');
            $table->text('payment_object')->nullable();
            $table->tinyInteger('payment_type')->comment('0 => by wallet, 1 => by gateway');
            $table->tinyInteger('payment_status')->comment('0 => pending, 1 => ok, 2 => failed');
            $table->tinyInteger('downloaded')->default(0)->comment('0 ->no , 1 -> yes');
            $table->timestamp('download_date')->nullable();
            $table->unsignedBigInteger('order_final_amount');
            $table->unsignedBigInteger('order_discount_amount');
            $table->unsignedBigInteger('order_total_discount');
            $table->tinyInteger('order_status')->comment('0 => pending, 1 => done, 2 => canceled, 3=> failed, 4 => refund');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
