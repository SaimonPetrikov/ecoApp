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
            $table->string('currency_code', 3); // Валюта операции
            $table->string('transaction_type'); // Тип транзакции: deposit, withdrawal, payment, refund и т.д.
            $table->string('description')->nullable(); // Описание операции
            $table->foreignId('task_id')->nullable()->constrained('tasks');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->timestamps();
            
            // Можно добавить индекс для часто запрашиваемых полей
            $table->index('transaction_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('billing');
    }
};
