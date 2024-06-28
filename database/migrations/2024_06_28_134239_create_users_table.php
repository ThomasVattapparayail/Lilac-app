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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('fk_department')->nullable();
            $table->unsignedBigInteger('fk_designation')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamps();

            $table->foreign('fk_department')->references('id')->on('departments');
            $table->foreign('fk_designation')->references('id')->on('designations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};