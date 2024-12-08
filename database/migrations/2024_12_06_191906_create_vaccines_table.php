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
        Schema::create('vaccines', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->string("name");
            $table->string("subtitle");
            $table->bigInteger("applicable_age_id");
            $table->enum("state", ["active", "inactive"])->default("active");
            $table->bigInteger("created_by");    
            $table->timestamps();

            $table->foreign("created_by")->on("employees")
                    ->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("applicable_age_id")->on("work_times")
                    ->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};
