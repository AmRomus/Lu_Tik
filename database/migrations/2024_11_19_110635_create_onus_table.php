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
        Schema::create('onus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('olt_ifaces_id')->nullable();
            $table->foreign('olt_ifaces_id','onu_iface')->references('id')->on('olt_ifaces')->nullOnDelete();
            $table->unsignedBigInteger('billing_account_id')->nullable();
            $table->foreign('billing_account_id','account_onu')->references('id')->on('billing_accounts')->nullOnDelete();
            $table->macAddress('mac');
            $table->string('onu_index')->nullable();
            $table->string('name')->nullable();
            $table->string('catv_access')->default(0);
            $table->string('state')->default(0);
            $table->boolean('online')->default(false);
            $table->string('msg')->nullable();
            $table->dateTime('last_state')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onus');
    }
};
