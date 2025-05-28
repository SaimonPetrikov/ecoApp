<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_billing_balance', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users');
        $table->string('currency_code', 3);
        $table->decimal('balance', 10, 2)->default(0);
        $table->timestamps();
        
        $table->unique(['user_id', 'currency_code']); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_billing_balance');
    }
};
