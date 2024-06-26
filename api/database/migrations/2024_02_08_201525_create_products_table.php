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
            $table->uuid('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('short_info')->nullable();
            $table->foreignUuid('category_id');
            $table->foreignUuid('subcategory_id')->nullable();
            $table->float('price');
            $table->longText('description')->nullable();
            $table->boolean('in_stock')->default(true);
            $table->boolean('visible')->default(true);
            $table->timestamps();
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
