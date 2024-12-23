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
        Schema::create('users_service_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('users_id')->unsigned();
            $table->unsignedBiginteger('service_companies_id')->unsigned();

            $table->foreign('users_id')->references('id')
                 ->on('service_companies')->onDelete('cascade');
            $table->foreign('service_companies_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_service_companies');
    }
};
