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
        Schema::create('boards', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->string('slug');
            $table->longText('description');
            $table->boolean('locked')->default(false);
            $table->foreignUlid('category_id');
            $table->foreignUlid('parent_id')->nullable();
            $table->index(['category_id', 'parent_id']);
            $table->unsignedInteger('weight')->default(0);
            $table->boolean('private')->default(false);
            $table->json('allowed_roles')->nullable();
            $table->json('allowed_users')->nullable();
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
        Schema::dropIfExists('boards');
    }
};
