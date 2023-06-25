<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method', 50);
            $table->string('payment_status', 50);
            $table->string('shipping_status', 50);
            $table->string('type', 50);
            $table->timestamp('date');

            $table->boolean('status')->default(true);
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('race_id')->nullable()->constrained('races');
            // $table->foreignId('service_id')->nullable()->constrained('services');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
