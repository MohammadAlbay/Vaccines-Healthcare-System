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
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();      /* المعرف             */
            $table->bigInteger("healthcare_id");            /* معرف المركز الصحي  */
            $table->bigInteger("vaccine_id");               /* معرف التطعيمة      */
            $table->bigInteger("for_id");                   /* معرف الابن          */
            $table->bigInteger("created_by");               /* معرف الاب           */
            $table->enum("state", 
            ["pending", "refused", "approved"])
                    ->default("pending");                    /* حالة الحجز         */
            $table->timestamp("date");                      /* تاريخ الحجز        */
            $table->timestamps();

            /* العلاقات:
            
            1 - علاقة الحجوزات ب المراكز الصحية
            2 - علاقة الحجوزات ب التطعيمات
            3 - علاقة الحجوزات ب المستخدمين (اب)
            4 - علاقة الحجوزات ب المستخدمين (ابن)
            
            */
            $table->foreign("healthcare_id")->on("healthcares")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("vaccine_id")->on("vaccines")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("for_id")->on("users")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("created_by")->on("users")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
