<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personal_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->binary('egn_encrypted')->nullable(); // For encrypted EGN
            $table->string('egn_hash', 64)->nullable(); // For searching
            $table->timestamps();

            $table->index('egn_hash');
        });

        DB::statement('ALTER TABLE personal_data MODIFY egn_encrypted VARBINARY(255)');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_data');
    }
};
