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
        Schema::create('age_categories', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->string("name");
            $table->string("visible_name")->nullable(true);
            $table->integer("min_age");
            $table->integer("max_age");
            $table->enum("state", ["active", "inactive"]);
            $table->bigInteger("created_by")->nullable(true);
            $table->timestamps();

            $table->foreign("created_by")->on("employees")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('age_categories');
    }
};
