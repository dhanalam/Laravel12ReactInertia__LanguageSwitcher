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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('code', 2);
            $table->string('image', 200)->nullable();
            $table->integer('order_no')->default(0);
            $table->boolean('default')->default(0);
            $table->boolean('is_active')->default(1);
            $table->dateTime('last_build_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
