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
        Schema::create('account_inet_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billing_account_id');
            $table->foreign('billing_account_id','account_inet_service')->references('id')->on('billing_accounts')->cascadeOnDelete();
            $table->unsignedBigInteger('inet_service_id')->nullable();
            $table->foreign('inet_service_id','link_inet')->references('id')->on('inet_services')->nullOnDelete();
            $table->unsignedBigInteger('mikro_bill_api_id')->nullable();
            $table->foreign('mikro_bill_api_id','service_api')->references('id')->on('mikro_bill_apis')->nullOnDelete();
            $table->string('api_ident')->nullable();
            $table->string('api_ssid')->nullable();
            $table->integer('service_state')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_inet_services');
    }
};
