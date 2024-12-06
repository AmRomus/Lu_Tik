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
        Schema::create('iptv_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billing_account_id');
            $table->foreign('billing_account_id','account_id')->references('id')->on('billing_accounts')->cascadeOnDelete();
            $table->string('ssid')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->macAddress('mac')->nullable();
            $table->string('dev_type')->nullable();
            $table->boolean('catch_up')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iptv_devices');
    }
};
