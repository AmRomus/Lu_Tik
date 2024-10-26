<?php

use App\Livewire\Finances\Tarifs;
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
        Schema::create('inet_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarif_id');
            $table->foreign('tarif_id','tarif_inet_service')->references('id')->on('tarifs')->cascadeOnDelete();          
            $table->unsignedBigInteger('speed_up')->default(0);
            $table->unsignedBigInteger('speed_up_unit')->nullable()->default('M');
            $table->unsignedBigInteger('speed_down')->default(0);
            $table->unsignedBigInteger('speed_down_unit')->nullable()->default('M');
            $table->integer('burst_percent')->default(0);
            $table->integer('burst_time')->default(1);
            $table->integer('price')->default(0);            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inet_services');
    }
};
