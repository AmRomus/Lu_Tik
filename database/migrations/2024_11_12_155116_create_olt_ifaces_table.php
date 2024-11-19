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
        Schema::create('olt_ifaces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('olt_id');
            $table->foreign('olt_id','olt_port')->references('id')->on('olts')->cascadeOnDelete();
            $table->string('if_index',30)->nullable();
            $table->string('pon_index',10)->nullable();
            $table->string('iface');
            $table->string('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('olt_ifaces');
    }
};
