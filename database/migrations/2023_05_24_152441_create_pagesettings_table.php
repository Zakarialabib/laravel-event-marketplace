<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagesettings', function (Blueprint $table) {
            $table->id();

            $table->json('headerSettings')->nullable();
            $table->json('footerSettings')->nullable();
            $table->json('themeColor')->nullable();
            $table->json('menuItems')->nullable();

            $table->boolean('popularProducts')->default(false);
            $table->boolean('flashDeal')->default(false);
            $table->boolean('bestSellers')->default(false);
            $table->boolean('topBrands')->default(false);

            $table->string('status')->default(true);
            $table->string('is_default')->default(false);

            $table->foreignId('page_id')->nullable()->constrained('pages')->nullOnDelete();
            $table->foreignId('language_id')->nullable()->constrained('languages')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagesettings');
    }
};
