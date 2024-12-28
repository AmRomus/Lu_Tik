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
        Schema::create('account_calls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billing_account_id');
            $table->foreign('billing_account_id','account_call')->references('id')->on('billing_accounts')->cascadeOnDelete();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id','call_user')->references('id')->on('users')->nullOnDelete();
            $table->text('theme');
            $table->boolean('solved')->default(true);
            $table->boolean('ticket')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_calls');
    }
};
