<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignUuid('participant_id')->constrained('participants');
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignUuid('race_id')->constrained('races');
            $table->decimal('amount', 8, 2);
            $table->string('payment_method');
            $table->string('status');
            $table->timestamp('date')->nullable();
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
