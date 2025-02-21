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
        Schema::create('billing_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('ident')->unique();
            $table->string('first')->nullable();
            $table->string('last')->nullable();
            $table->string('middle')->nullable();
            $table->string('phone')->nullable();
            $table->string('passport')->nullable();
            $table->string('passport_region',4)->nullable();
            $table->string('passport_file')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id','account_address')->references('id')->on('addresses')->nullOnDelete();
            $table->unsignedBigInteger('tarif_id')->nullable();
            $table->foreign('tarif_id','tarif_ident')->references('id')->on('tarifs')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_accounts');
    }
};
