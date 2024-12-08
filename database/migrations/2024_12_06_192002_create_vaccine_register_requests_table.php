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
        Schema::create('vaccine_register_requests', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->string("name");
            $table->string("subtitle");
            $table->bigInteger("applicable_age_id");
            $table->enum("state", ["approved", "pending", "refused"])->default("pending");
            $table->bigInteger("healthcare_id");
            $table->bigInteger("vaccine_id")->nullable();
            $table->timestamps();

            $table->foreign("healthcare_id")->on("healthcares")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("vaccine_id")->on("vaccines")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("applicable_age_id")->on("work_times")
                    ->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccine_register_requests');
    }
};
