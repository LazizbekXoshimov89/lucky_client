<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket')->unique();
            $table->Integer('contract_number');
            $table->string('client_fio');
            $table->string('workplace');
            $table->string('filial');
            $table->string('phone_number');
            $table->foreignId('gift_id')->constrained('gifts');
            $table->boolean('is_winner')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
