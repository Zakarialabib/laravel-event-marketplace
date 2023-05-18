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
            $table->foreignId('race_id')->constrained('races');
            $table->foreignId('winner_id')->nullable()->constrained('participants');
            $table->foreignId('runner_up_id')->nullable()->constrained('participants');
            $table->integer('place');
            $table->string('time');
            $table->timestamp('date')->nullable();
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
