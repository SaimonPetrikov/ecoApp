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
            $table->foreignId('user_id')->constrained('users')->unique();
            $table->decimal('balance', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_billing_balance');
    }
};
