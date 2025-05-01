<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('address');
            $table->string('phone');
            $table->string('delivery_time');
            $table->string('payment_method');
            $table->string('payment_id')->nullable();
            $table->string('payment_status')->default('pending');
            $table->decimal('total', 10, 2);
            $table->decimal('delivery_fee', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}; 