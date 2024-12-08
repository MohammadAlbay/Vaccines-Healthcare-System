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
        Schema::create('healthcare_rates', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();        /* المعرف                 */
            $table->bigInteger("healthcare_id");              /* معرف المركز الصحي      */
            $table->bigInteger("parent_id");                  /* معرف ولي الامر          */
            $table->integer("rate");                          /* التقييم                */
            $table->integer("description");                   /* وصف التقييم            */


             /* العلاقات:
            
            1 - علاقة التقييمات ب المراكز الصحية
            2 - علاقة التقييمات ب المستخدمين (الاب)
            
            */
            $table->foreign("healthcare_id")->on("healthcares")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("parent_id")->on("users")->references("id")
                                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('healthcare_rates');
    }
};
