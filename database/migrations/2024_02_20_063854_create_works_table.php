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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('company_id');
            $table->year('from_year')->nullable();
            $table->unsignedInteger('from_month')->nullable();
            $table->unsignedInteger('from_date')->nullable();
            $table->year('to_year')->nullable();
            $table->unsignedInteger('to_month')->nullable();
            $table->unsignedInteger('to_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};