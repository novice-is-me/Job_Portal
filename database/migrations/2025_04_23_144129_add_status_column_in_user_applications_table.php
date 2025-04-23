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
        Schema::table('user_applications', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('status')->nullable()->after('is_applied');
            $table->foreign('status')->references('id')->on('job_status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_applications', function (Blueprint $table) {
            //
            $table->dropForeign(['status']);
            $table->dropColumn('status');
        });
    }
};
