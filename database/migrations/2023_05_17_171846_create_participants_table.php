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
            $table->uuid('id')->primary();
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
            $table->longText('health_informations')->nullable();
            $table->string('medical_history')->nullable();
            $table->string('taking_medications')->nullable();
            $table->string('medication_allergies')->nullable();
            $table->string('sensitivities')->nullable();
            $table->string('status')->nullable();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
