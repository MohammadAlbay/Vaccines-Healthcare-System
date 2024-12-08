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
        Schema::create('side_effects', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->string("name");
            $table->string("description");
            $table->enum("state", ["active", "inactive", "pending"])->default("pending");
            $table->bigInteger("created_by");
            $table->bigInteger("approved_by");
            $table->bigInteger("vaccine_id");
            $table->timestamps();

            $table->foreign("approved_by")->on("employees")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("created_by")->on("healthcares")->references("id")
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
        Schema::dropIfExists('side_effects');
    }
};
