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
        Schema::create('rekenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained('invitations')->onDelete('cascade');
            $table->enum('role', ['bride', 'groom']); // bride = pengantin wanita, groom = pria
            $table->foreignId('bank_id')->constrained()->onDelete('cascade');
            $table->string('nama'); // Nama pemilik rekening
            $table->string('nomor_rekening'); // No rekening
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekenings');
    }
};
