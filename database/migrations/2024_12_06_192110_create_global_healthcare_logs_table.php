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
        Schema::create('global_healthcare_logs', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();        /* المعرف                 */
            $table->bigInteger("healthcare_id");              /* معرف المركز الصحي      */
            $table->bigInteger("vaccine_id");                 /* معرف التطعيمة          */
            $table->bigInteger("user_id");                    /* معرف الشخص النطعم      */
            $table->bigInteger("reservation_id")->nullable(); /* معرف الحجز             */
            $table->enum("state",
            ["done", "canceled"]);                           /* حالة التطعيمة          */
            $table->string("mother_name")->nullable();        /* اسم الام                */
            $table->string("child_name")->nullable();         /* اسم الطفل              */
            $table->string("mother_national_id")->nullable(); /* الرقم الوطني للام       */


             /* العلاقات:
            
            1 - علاقة السجل ب المراكز الصحية
            2 - علاقة السجل ب التطعيمات
            3 - علاقة السجل ب المستخدمين (المطعم)
            4 - علاقة السجل ب الحجوزات
            
            */
            $table->foreign("healthcare_id")->on("healthcares")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("vaccine_id")->on("vaccines")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("user_id")->on("users")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("reservation_id")->on("reservations")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_healthcare_logs');
    }
};
