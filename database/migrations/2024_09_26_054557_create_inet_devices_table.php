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
        Schema::create('inet_devices', function (Blueprint $table) {
            $table->id();
            $table->macAddress('mac')->unique();
            $table->ipAddress('ip')->nullable();
            $table->unsignedBigInteger('billing_account_id')->nullable();
            $table->foreign('billing_account_id','account_inet_device')->references('id')->on('billing_accounts')->nullOnDelete();
            $table->unsignedBigInteger('inet_service_id')->nullable();
            $table->foreign('inet_service_id','service_device')->references('id')->on('inet_services')->nullOnDelete();
            $table->unsignedBigInteger('control_interface_id')->nullable();
            $table->foreign('control_interface_id','control_interface_device')->references('id')->on('control_interfaces')->nullOnDelete();            
            $table->string('dhcp_server')->nullable();
            $table->string('hostname')->nullable();
            $table->boolean('online')->default(false);
            $table->boolean('bind')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inet_devices');
    }
};
