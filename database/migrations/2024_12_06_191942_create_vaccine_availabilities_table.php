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
        Schema::create('vaccine_availabilities', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->boolean("available")->Default(false);
            $table->enum("state", ["active", "inactive"])->default("active");
            $table->bigInteger("healthcare_id");
            $table->bigInteger("vaccine_id");
            $table->timestamps();

            $table->foreign("healthcare_id")->on("healthcares")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("vaccine_id")->on("vaccines")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccine_availabilities');
    }
};
