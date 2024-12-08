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
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->string('first_name');
            $table->string('last_name');
            $table->string("email")->unique();
            $table->string("password");
            $table->enum("account_type", ["parent", "child"]);
            $table->bigInteger("family_number")->nullable();
            $table->enum("account_state", ["active", "inactive", "blocked", "pending"])->default("pending");
            $table->enum("gender", ["male", "female"]);
            $table->timestamp("birthdate");
            $table->string("profile");
            $table->string("activate_code");
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            // $table->foreign("family_number")->on("family_books")
            //         ->references("id")->cascadeOnDelete()->cascadeOnUpdate();

            // 
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->string('owner_type')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
