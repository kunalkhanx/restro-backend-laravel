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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('table_id')->nullable();
            $table->unsignedBigInteger('waiter_id')->nullable();
            $table->date('date');
            $table->double('total')->default(0);
            $table->double('discount')->default(0);
            $table->json('tax')->nullable();
            $table->double('final')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('table_id')->references('id')->on('tables')->onDelete('set null');
            $table->foreign('waiter_id')->references('id')->on('waiters')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
