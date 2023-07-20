<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('participant_id')->constrained('participants');
            $table->foreignUuid('race_id')->constrained('races');
            // $table->foreignId('order_id')->constrained('orders');
            // $table->foreignId('payment_id')->constrained('payments');
            $table->string('registration_number')->unique();
            $table->timestamp('registration_date')->nullable();
            $table->string('status');
            $table->timestamp('date')->nullable();
            $table->text('additional_informations')->nullable();
            $table->json('additional_services')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
