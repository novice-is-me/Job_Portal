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
        Schema::table('user_work_experiences', function (Blueprint $table) {
            //
            $table->boolean('is_current_job')->default(0)->after('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_work_experiences', function (Blueprint $table) {
            //
            $table->dropColumn('is_current_job');
        });
    }
};
