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
             $table->string('name');
            // store image path relative to storage/app/public
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            // user-supplied boolean flags; default false
            $table->boolean('add_to_card')->default(false);
            $table->boolean('wishlist')->default(false);
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
