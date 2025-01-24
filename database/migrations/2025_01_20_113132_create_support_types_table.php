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
        Schema::create('support_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('bg_color')->default('warning');
            $table->string('tx_color')->default('black');
            $table->integer('hrs')->default(48);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_types');
    }
};
