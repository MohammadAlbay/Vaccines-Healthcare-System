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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email")->unique();
            $table->string("password");
            $table->bigInteger("role");
            
            $table->enum("account_state", ["active", "inactive", "pending"]);
            $table->enum("gender", ["male", "female"]);
            $table->timestamp("birthdate");
            $table->string("profile");
            $table->bigInteger("created_by")->nullable(true);
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign("role")->on("roles")->references("id")
                    ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign("created_by")->on("employees")->references("id")
                    ->cascadeOnDelete()->cascadeOnUpdate();   
                
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
