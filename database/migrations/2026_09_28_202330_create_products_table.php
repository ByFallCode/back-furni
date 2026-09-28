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
            $table->string("name", 250);
            $table->string("description", 250)->nullable();
            $table->bigInteger("price")->unsigned();
            $table->bigInteger("stock")->unsigned();
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->string("image", 250)->nullable();
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
