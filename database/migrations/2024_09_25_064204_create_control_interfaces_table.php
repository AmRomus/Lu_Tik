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
        Schema::create('control_interfaces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mikrotik_id')->nullable();
            $table->foreign('mikrotik_id','mikrotik_device')->references('id')->on('mikrotiks')->cascadeOnDelete();
            $table->string('interface');
            $table->string('ident');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('control_interfaces');
    }
};
