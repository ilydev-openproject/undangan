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
        Schema::table('invitations', function (Blueprint $table) {
            $table->string('bride_title')->nullable()->after('bride_name');
            $table->string('groom_title')->nullable()->after('groom_name');
            $table->string('bride_child_order')->nullable()->after('bride_title');
            $table->string('groom_child_order')->nullable()->after('groom_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            //
        });
    }
};
