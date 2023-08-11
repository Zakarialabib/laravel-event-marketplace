<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('race_results', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('race_id')->constrained('races');
            $table->foreignUuid('participant_id')->nullable()->constrained('participants');
            $table->foreignUuid('registration_id')->nullable()->constrained('registrations');
            $table->integer('place')->nullable();
            $table->string('time')->nullable();
            $table->dateTime('date')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('race_results');
    }
};
