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
        Schema::create('snmp_oids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('olt_template_id');
            $table->foreign('olt_template_id','templ_snmp')->references('id')->on('olt_templates')->cascadeOnDelete();           
            $table->text('cmd')->nullable();
            $table->text('oid')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('snmp_oids');
    }
};
