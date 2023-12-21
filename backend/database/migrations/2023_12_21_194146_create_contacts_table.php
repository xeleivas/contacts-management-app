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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email'); // We use the default length here
            $table->string('address', 200);
            $table->string('phone_number', 50); // Phone numbers can be up to 15 digits long. But we'll use 50 just in case of prefixes and such.
            $table->string('profile_picture_url', 2048); // Max length of a URL is 2048 characters.
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
