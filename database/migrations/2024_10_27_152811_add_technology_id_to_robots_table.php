<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('robots', function (Blueprint $table) {
            $table->foreignId('technology_id')->constrained('technologies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('robots', function (Blueprint $table) {
            $table->dropForeign(['technology_id']);
            $table->dropColumn('technology_id');
        });
    }
};