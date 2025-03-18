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
            $table->text('about_role')->after('work_setup')->nullable();
            $table->text('responsibilities')->after('about_role')->nullable();
            $table->text('requirements')->after('responsibilities')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
            $table->dropColumn('about_role');
            $table->dropColumn('responsibilities');
            $table->dropColumn('requirements');
        });
    }
};
