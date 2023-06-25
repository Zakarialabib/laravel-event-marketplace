<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('gender');
            $table->string('country');
            $table->date('birth_date');
            $table->string('address');
            $table->string('city');
            $table->string('zip_code');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone_number');
            $table->text('health_informations');
            $table->boolean('medical_history')->default(false);
            $table->boolean('taking_medications')->default(false);
            $table->boolean('medication_allergies')->default(false);
            $table->boolean('sensitivities')->default(false);
            $table->boolean('status')->default(true);
            $table->foreignId('race_location_id')->constrained('race_locations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
