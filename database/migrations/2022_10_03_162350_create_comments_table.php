<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->longText('body');
            $table->foreignUlid('commenter_id');
            $table->string('commenter_type');
            $table->foreignUlid('commentable_id');
            $table->string('commentable_type');
            $table->index(['commentable_type', 'commentable_id']);
            $table->index(['commenter_type', 'commenter_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
