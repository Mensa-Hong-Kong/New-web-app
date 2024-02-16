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
        Schema::create('user_admission_tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( "admission_test_id" );
            $table->boolean( "is_attend" );
            $table->dateTime( "resulted_at" );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_admission_tests');
    }
};
