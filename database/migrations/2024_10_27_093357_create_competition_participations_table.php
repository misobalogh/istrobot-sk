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
        Schema::create('participations', function (Blueprint $table) {
            $table->foreignId('robot_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('competition_id')->constrained()->onDelete('cascade');
            $table->integer('start_number')->nullable();
            $table->string('result', 10)
                ->check('result IN ("MP", "DNS") OR CAST(result AS INTEGER) >= 0');
            $table->primary(['competition_id', 'robot_id', 'category_id']);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participations');
    }
};
