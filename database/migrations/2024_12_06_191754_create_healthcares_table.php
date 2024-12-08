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
        Schema::create('healthcares', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->string('name');
            $table->string('address');
            $table->string('location');
            $table->string("email")->unique();
            $table->string("password");
            $table->enum("account_state", ["active", "inactive", "blocked", "pending"])->default("pending");
            $table->string("profile")->nullable();
            $table->string("activate_code");
            $table->string("official_document");
            $table->timestamp('when_approved')->nullable();
            $table->boolean('is_vacation')->default(false);
            $table->string("vacation_description")->nullable(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('healthcares');
    }
};
