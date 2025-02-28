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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('slug')->unique()->nullable();
            $table->text('image')->nullable();
            $table->bigInteger('price');
            $table->tinyInteger('type')->comment('0->textual , 1->Audio');
            $table->integer('page_count')->nullable();
            $table->integer('release_year');
            $table->foreignId('product_category_id')->constrained('product_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('writer_id')->constrained('writers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('publisher_id')->constrained('publishers')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('discounted_price')->nullable(); // discounted price will be calculated based on disscount_percentage
            $table->bigInteger('discount_percentage')->nullable();
            $table->timestamp('disscount_expires_at')->nullable(); // for having a timer at home page page
            $table->bigInteger('sold_number')->default(0);
            $table->bigInteger('view_count')->default(0);
            $table->bigInteger('suggested_count')->default(0); // for having suggested books on home page
            $table->tinyInteger(column: 'status')->default(0)->comment('0->available 1->unavailable');
            $table->tinyInteger(column: 'marketable')->default(0)->comment('0->yes 1->no'); // available for sale or not
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
