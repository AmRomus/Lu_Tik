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
        Schema::create('account_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billing_account_id')->nullable();
            $table->foreign('billing_account_id','account_subscription')->references('id')->on('billing_accounts')->cascadeOnDelete();
            $table->unsignedBigInteger('tarif_id')->nullable();
            $table->foreign('tarif_id','tarif_subscription')->references('id')->on('tarifs')->nullOnDelete();           
            $table->dateTime('acct_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_subscriptions');
    }
};
