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
        Schema::create('mikro_bill_apis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('host')->unique();
            $table->string('login');
            $table->string('password')->nullable();
            $table->string('key1')->nullable();
            $table->string('key2')->nullable();
            $table->integer('port')->default(7403);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mikro_bill_apis');
    }
};
