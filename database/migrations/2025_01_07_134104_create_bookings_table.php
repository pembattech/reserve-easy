<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade'); // Foreign key to vendors table
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // Foreign key to clients table
            $table->date('booking_date');
            $table->integer('guest');
            $table->enum('shift', ['morning', 'evening', 'whole_day']); // Shift options: morning, evening, whole day
            $table->enum('type', ['wedding', 'birthday', 'corporate_event', 'other']); // Type options: wedding, birthday, corporate_event, other
            $table->string('status')->default('pending'); // Status: pending, confirmed, canceled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
