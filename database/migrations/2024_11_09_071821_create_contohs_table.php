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
        Schema::create('contohs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jeniskelamin',['cowok','cewek']);
            $table->bigInteger('telpon');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contohs');
    }
};
