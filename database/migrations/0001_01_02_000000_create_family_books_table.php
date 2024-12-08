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
        Schema::create('family_books', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->integer("number")->unique();
            $table->bigInteger("parent");
            $table->integer("max_age");
            $table->enum("state", ["active", "inactive"]);
            $table->timestamps();

            $table->foreign("parent")->on("users")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_books');
    }
};
