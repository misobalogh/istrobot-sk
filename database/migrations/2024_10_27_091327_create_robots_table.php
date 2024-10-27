<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('robots', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('coauthors', 255)->nullable();
            $table->string('processor', 50);
            $table->integer('memory_size')->nullable();
            $table->integer('frequency');
            $table->string('sensors', 255)->nullable();
            $table->string('drive', 255)->nullable();
            $table->string('power_supply', 255)->nullable();
            $table->string('programming_language', 30);
            $table->string('interesting_facts', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->foreignId('user_id')->constrained('users');
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
