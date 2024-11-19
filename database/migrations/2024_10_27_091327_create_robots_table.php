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
        Schema::create('robots', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('author_first_name', 255);
            $table->string('author_last_name', 255);
            $table->string('coauthors', 255)->nullable();
            $table->string('processor', 255);
            $table->string('memory_size')->nullable();
            $table->string('frequency', 255);
            $table->string('sensors', 255)->nullable();
            $table->string('drive', 255)->nullable();
            $table->string('power_supply', 255)->nullable();
            $table->string('programming_language', 30);
            $table->string('interesting_facts', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robots');
    }
};
