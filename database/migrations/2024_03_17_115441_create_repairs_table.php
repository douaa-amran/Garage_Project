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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('status');
            $table->date('startDate');
            $table->date('endDate');
            $table->text('mechanicNotes');
            $table->text('clientNotes');
            $table->unsignedBigInteger('clientId');
            $table->foreign('clientId')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedBigInteger('mechanicId');
            $table->foreign('mechanicId')->references('id')->on('mechanics')->onDelete('cascade');
            $table->unsignedBigInteger('vehicleId');
            $table->foreign('vehicleId')->references('id')->on('vehicles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
