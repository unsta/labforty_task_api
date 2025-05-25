<?php

use App\Enums\BookingStatus;
use App\Enums\NotificationType;
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
        Schema::create('booking_hours', function (Blueprint $table) {
            $table->id();
            $table->date('booking_date');
            $table->foreignId('time_slot_id')->constrained()->onDelete('restrict');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->integer('notification_types')->default(NotificationType::EMAIL->value)->nullable()->comment('Using bit flags');
            $table->enum('status', BookingStatus::values());
            $table->timestamps();
            $table->softDeletes();

            $table->index('booking_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_hours');
    }
};
