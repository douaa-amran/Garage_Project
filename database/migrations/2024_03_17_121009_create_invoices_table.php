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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('repairId');
            $table->foreign('repairId')->references('id')->on('repairs')->onDelete('cascade');
            $table->unsignedBigInteger('sparepartId');
            $table->foreign('sparepartId')->references('id')->on('spareparts')->onDelete('cascade');
            $table->integer('quantity');
            $table->float('additionalCharges');
            $table->float('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
