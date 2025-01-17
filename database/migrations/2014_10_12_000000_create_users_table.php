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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('nickname')->nullable();
            $table->string('given_name');
            $table->string('middle_name')->nullable();
            $table->string('family_name');
            $table->date('date_of_birth');
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('notification_email_id');
            $table->unsignedBigInteger('notification_mobile_id');
            $table->unsignedBigInteger('default_address_id');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
