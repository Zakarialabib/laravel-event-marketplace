<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->foreignId('race_location_id')->constrained('race_locations');
            $table->foreignId('category_id')->constrained('categories');
            $table->integer('number_of_days')->nullable();
            $table->integer('number_of_racers');
            $table->decimal('price', 8, 2);
            $table->json('images');
            $table->json('social_media');
            $table->json('sponsors');
            $table->json('course');
            $table->json('features');
            $table->json('options');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
