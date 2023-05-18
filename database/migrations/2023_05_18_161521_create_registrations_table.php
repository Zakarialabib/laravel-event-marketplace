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
            $table->id();
            $table->foreignId('participant_id')->constrained('participants');
            $table->foreignId('race_id')->constrained('races');
            $table->timestamp('registration_date')->nullable();
            $table->string('status');
            $table->timestamp('date')->nullable();
            $table->text('additional_informations')->nullable();
            $table->json('additional_services')->nullable();
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
