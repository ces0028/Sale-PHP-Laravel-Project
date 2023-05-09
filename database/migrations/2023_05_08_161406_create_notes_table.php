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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('in_out')->nullable();
            $table->date('write_date')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('price')->nullable();
            $table->integer('num_in')->nullable();
            $table->integer('num_out')->nullable();
            $table->integer('total_price')->nullable();
            $table->string('note', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
