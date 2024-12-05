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
        Schema::create('iptv_streams_play_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('play_list_id');
            $table->unsignedBigInteger('iptv_streams_id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('play_list_id','playlist_channel')->references('id')->on('play_lists')->cascadeOnDelete();
            $table->foreign('iptv_streams_id','stream_channel')->references('id')->on('iptv_streams')->cascadeOnDelete();           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iptv_streams_play_list');
    }
};
