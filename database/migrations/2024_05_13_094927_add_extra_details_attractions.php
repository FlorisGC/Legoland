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
        Schema::table('attractions', function (Blueprint $table) {
            $table->text('description_short');
            $table->integer('minimum_age');
            $table->double('minimum_height');
            $table->double('maximum_weight');
            $table->double('wait_time');
            $table->text('restrictions');
            $table->date('inauguration_date')->default('2024-01-01');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attractions', function (Blueprint $table) {
            $table->dropColumn('description_short');
            $table->dropColumn('minimum_age');
            $table->dropColumn('minimum_height');
            $table->dropColumn('maximum_weight');
            $table->dropColumn('wait_time');
            $table->dropColumn('restrictions');
            $table->dropColumn('inauguration_date');
        });
    }
};
