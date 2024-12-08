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
        Schema::create('o_t_p_s', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();                    /* المعرف                 */          
            $table->string('code')->unique(true);              /* رقم عشوائي             */
            $table->timestamp('due')
                        ->default(now()->addMinutes(30));           /* تاريخ صلاحية الرقم      */
            $table->boolean('used')->default(false);               /* حالة الرقم             */
            $table->string('email');                                      /* ايميل                  */
            $table->morphs('owner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('o_t_p_s');
    }
};
