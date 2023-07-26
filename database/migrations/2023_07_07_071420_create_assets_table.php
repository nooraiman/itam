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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tag');
            $table->string('serial_number');
            $table->enum('status', ['1', '2', '3', '4', '5']); 
            // 1 - Available, 2 - Assigned, 3 - Maintenance, 4 - Defective - 5 - Retired
            $table->unsignedBigInteger('assigned_to')->nullable()->default(null);
            $table->unsignedBigInteger('model_id');
            
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            $table->foreign('model_id')->references('id')->on('asset_models')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
