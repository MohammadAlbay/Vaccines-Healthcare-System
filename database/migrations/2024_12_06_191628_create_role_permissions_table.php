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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->bigInteger("role_id");
            $table->bigInteger("permission_id");
            $table->enum("state", ["active", "inactive"]);
            $table->timestamps();

            $table->foreign("role_id")->on("roles")->references("id")
                    ->cascadeOnDelete()->cascadeOnUpdate();
            
            $table->foreign("permission_id")->on("permissions")->references("id")
                    ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
