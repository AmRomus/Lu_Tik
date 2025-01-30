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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billing_account_id');
            $table->foreign('billing_account_id','account_ticket')->references('id')->on('billing_accounts')->cascadeOnDelete();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id','ticket_user')->references('id')->on('users')->nullOnDelete();
            $table->integer('ticket_type')->default(1);
            $table->text('alter_phone')->nullable();
            $table->longText('description')->nullable();
            $table->integer('priority')->default(0);
            $table->dateTime('planed_time')->nullable();            
            $table->boolean('processed')->default(false);
            $table->integer('processed_relation')->nullable();
            $table->text('processed_comment')->nullable();
            $table->dateTime('processed_time')->nullable();
            $table->boolean('finished')->default(false);
            $table->unsignedBigInteger('finished_id')->nullable();
            $table->foreign('finished_id','ticket_finished')->references('id')->on('users')->nullOnDelete();
            $table->text('finish_comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
