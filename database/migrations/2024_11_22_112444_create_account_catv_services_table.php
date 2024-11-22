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
        Schema::create('account_catv_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billing_account_id');
            $table->foreign('billing_account_id','account_catv_service')->references('id')->on('billing_accounts')->cascadeOnDelete();
            $table->unsignedBigInteger('catv_service_id')->nullable();
            $table->foreign('catv_service_id','link_catv')->references('id')->on('catv_services')->nullOnDelete();
            $table->unsignedBigInteger('mikro_bill_api_id')->nullable();
            $table->foreign('mikro_bill_api_id','catv_service_api')->references('id')->on('mikro_bill_apis')->nullOnDelete();
            $table->string('api_ident')->nullable();
            $table->string('api_ssid')->nullable();
            $table->dateTime('api_check')->nullable();
            $table->integer('service_state')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_catv_services');
    }
};
