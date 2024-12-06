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
        Schema::create('iptv_stream_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iptv_stream_id');
            $table->foreign('iptv_stream_id','stream_stat_id')->references('id')->on('iptv_streams')->cascadeOnDelete();
            $table->unsignedBigInteger('iptv_device_id');
            $table->foreign('iptv_device_id','iptv_device_stat')->references('id')->on('iptv_devices')->cascadeOnDelete();
            $table->boolean('is_live')->default(true);
            $table->dateTime('show_start');
            $table->dateTime('show_stop')->nullable();
            $table->unsignedBigInteger('view_time')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iptv_stream_stats');
    }
};
