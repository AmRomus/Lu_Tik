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
        Schema::create('olts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->ipAddress('ip');
            $table->unsignedBigInteger('olt_template_id')->nullable();
            $table->string('ro_community')->default('public');
            $table->string('ro_community_pass')->nullable();
            $table->string('rw_community')->default('private');
            $table->string('rw_community_pass')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('olts');
    }
};
