<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('task_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->references('id')->on('tasks');
            $table->boolean('is_automative_approve')->default(false);
            $table->foreignId('approve_role_id')->constrained('roles');
            $table->json('conditions');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('task_conditions');
    }
};
