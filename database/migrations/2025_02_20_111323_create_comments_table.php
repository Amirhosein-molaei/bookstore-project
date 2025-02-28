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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type');
            // showing in a comment that the user who has written the comment has bought the product or not
            $table->tinyInteger('has_bought')->default(0)->comment('0->no, 1->yes');
            $table->tinyInteger('rate')->default(0)->comment('0->not rated, from 1 to 5-> points out of 5');
            $table->tinyInteger('status')->default(0)->comment('0 => unseen, 1 =>seen, 2 => approved');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
