<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams');
            $table->foreignId('participant_id')->constrained('participants');
            $table->unique(['team_id', 'participant_id']);
            $table->json('invitation_emails')->nullable();
            $table->boolean('is_accepted')->default(false);
            $table->timestamp('invitation_sent_at')->nullable();
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
