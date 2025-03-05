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
            $table->dropColumn('payload');
            $table->unsignedBigInteger('category_id')->after('type')->nullable();
            $table->unsignedBigInteger('recruiter_id')->after('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('recruiter_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
            $table->string('payload')->after('type')->nullable();
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropForeign(['recruiter_id']);
            $table->dropColumn('recruiter_id');
        });
    }
};
