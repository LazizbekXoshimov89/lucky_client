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
            $table->integer('client_id');
            $table->boolean('active')->default(false);
            $table->string('workplace');
            $table->string('filial');
            $table->integer('filial_id')->constrained('organizations')->onDelete('cascade');
            $table->string('phone_number');
            $table->foreignId('gift_id')->nullable()
                ->constrained('gifts')
                ->onDelete('cascade');
            $table->boolean('is_winner')->default(false);
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
