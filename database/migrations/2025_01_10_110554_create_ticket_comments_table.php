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
        Schema::create('ticket_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('user_id')->unsigned();
            $table->foreign('user_id','user_ticket_comment')->references('id')
            ->on('users')->onDelete('cascade');
            $table->text('comment');
            $table->unsignedBiginteger('support_ticket_id')->unsigned();
            $table->foreign('support_ticket_id','support_ticket_comment')->references('id')
            ->on('support_tickets')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_comments');
    }
};
