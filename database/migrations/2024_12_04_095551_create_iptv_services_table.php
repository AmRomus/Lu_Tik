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
        Schema::create('iptv_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarif_id');
            $table->foreign('tarif_id','tarif_iptv_service')->references('id')->on('tarifs')->cascadeOnDelete();          
            $table->unsignedBigInteger('service_companies_id');
            $table->foreign('service_companies_id','company_iptv_service')->references('id')->on('service_companies')->cascadeOnDelete();          
            $table->integer('price')->default(0);
            $table->unsignedBigInteger('play_list_id')->nullable();
            $table->foreign('play_list_id','iptv_service_playlist')->references('id')->on('play_lists')->nullOnDelete();
            $table->integer('iptv_devices')->default(0);          
            $table->integer('smart_devices')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iptv_services');
    }
};
