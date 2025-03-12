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
        Schema::create('organization_gifts', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id')->nullable()->constrained('organizations');
            $table->integer('gift_id')->nullable()->constrained('gifts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_gifts');
    }
};
