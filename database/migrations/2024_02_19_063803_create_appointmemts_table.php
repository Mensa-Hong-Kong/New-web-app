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
        Schema::create('appointmemts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('organize_id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('role_id');
            $table->year('from_year');
            $table->integer('from_mouth');
            $table->integer('from_date');
            $table->date('from');
            $table->year('to_year');
            $table->integer('to_mouth');
            $table->integer('to_date');
            $table->date('to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointmemts');
    }
};
