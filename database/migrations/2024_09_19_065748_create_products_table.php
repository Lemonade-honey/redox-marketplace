<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('categorie_id');
            $table->text('description');
            $table->integer('price');
            $table->integer('stocks')->default(0);
            $table->integer('sold')->default(0);
            $table->text('configs');
            $table->enum("status", ["ACTIVE", "NOT ACTIVE"])->default("NOT ACTIVE");
            $table->timestamps();

            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
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
