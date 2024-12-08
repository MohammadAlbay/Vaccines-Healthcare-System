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
        Schema::create('private_parent_logs', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();        /* المعرف                 */
            $table->bigInteger("vaccine_id");                 /* معرف التطعيمة          */
            $table->bigInteger("child_id");                   /* معرف الشخص المطعم      */
            $table->integer("when_age");                                  /* عمر الطفل عند التطعيم  */


             /* العلاقات:
            
            1 - علاقة السجل ب التطعيمات
            2 - علاقة السجل ب المستخدمين (المطعم)
            
            */
            $table->foreign("vaccine_id")->on("vaccines")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("child_id")->on("users")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_parent_logs');
    }
};
