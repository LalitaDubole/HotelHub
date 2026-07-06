<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('type'); // Deluxe, Suite, Standard
        $table->text('description');
        $table->decimal('price_per_night', 8, 2);
        $table->integer('capacity');
        $table->string('image')->nullable();
        $table->enum('status', ['available', 'booked', 'maintenance'])
              ->default('available');
        $table->json('amenities')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
