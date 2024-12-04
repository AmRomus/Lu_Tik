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
        Schema::create('iptv_streams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('stream_url');
            $table->string('tvg_id')->nullable();
            $table->string('tvg_ico')->nullable();
            $table->boolean('have_catchup')->default(false);
            $table->text('catchup_server')->nullable();
            $table->time('show_start')->default('00:00:00');
            $table->time('show_stop')->default('23:59:59');
            $table->boolean('is_ott')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iptv_streams');
    }
};
