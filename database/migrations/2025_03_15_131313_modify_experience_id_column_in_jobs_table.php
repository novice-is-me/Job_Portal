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
        Schema::table('jobs', function (Blueprint $table) {
            //
            $table->string('work_setup')->after('status')->nullable();
            $table->unsignedBigInteger('experience_id')->after('recruiter_id')->nullable();
            $table->foreign('experience_id')->references('id')->on('experience_levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
            $table->dropColumn('work_setup');
            $table->dropForeign(['experience_id']);
            $table->dropColumn('experience_id');
        });
    }
};
