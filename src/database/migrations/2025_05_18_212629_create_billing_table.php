<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_billing_id')->constrained('user_billing_balance');
            $table->decimal('amount', 10, 2);
            $table->foreignId('task_id')->nullable()->constrained('tasks');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('billing');
    }
};
