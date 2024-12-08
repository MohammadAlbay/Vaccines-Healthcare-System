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
        Schema::create('work_times', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->bigInteger("healthcare_id");
            $table->enum("day", [1,2,3,4,5,6,7]);
            $table->time("from");
            $table->time("to");
            $table->timestamps();

            $table->foreign("healthcare_id")->on("healthcares")
                    ->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_times');
    }
};
