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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');               // Name of the client
            $table->string('email')->unique();    // Email of the client, unique
            $table->string('contact');            // Contact number
            $table->string('OPT')->nullable();    // Optional field, can be null
            $table->boolean('is_valid')->default(false); // Boolean field, defaults to false
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
