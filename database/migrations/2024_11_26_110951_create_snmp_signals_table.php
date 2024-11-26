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
        Schema::create('snmp_signals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('snmp_template_id');
            $table->foreign('snmp_template_id','templ_signals')->references('id')->on('snmp_templates')->cascadeOnDelete();           
            $table->text('signal')->nullable();
            $table->text('action')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('snmp_signals');
    }
};
