<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('triathlon_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('number')->unsigned();
            $table->string('name');

            $table->integer('swimmerParticipantId')->unsigned();
            $table->string('swimmerName');
            $table->smallInteger('swimmerBirthYear');
            $table->string('swimmerGender');

            $table->integer('bikerParticipantId')->unsigned();
            $table->string('bikerName');
            $table->smallInteger('bikerBirthYear');
            $table->string('bikerGender');

            $table->integer('runnerParticipantId')->unsigned();
            $table->string('runnerName');
            $table->smallInteger('runnerBirthYear');
            $table->string('runnerGender');

            $table->time('finish')->nullable()->default(null);
            $table->time('penalty')->nullable()->default(null);
            $table->text('comment')->nullable()->default(null);
            $table->smallInteger('eventYear');
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('triathlon_teams');
    }
};
