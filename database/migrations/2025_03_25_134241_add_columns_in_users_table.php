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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->text('headline')->after('phone')->nullable();
            $table->text('introduction')->after('headline')->nullable();
            $table->string('website')->after('introduction')->nullable();
            $table->string('linkedin')->after('website')->nullable();
            $table->string('github')->after('linkedin')->nullable();
            $table->string('portfolio')->after('github')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('headline');
            $table->dropColumn('introduction');
            $table->dropColumn('website');
            $table->dropColumn('linkedin');
            $table->dropColumn('github');
            $table->dropColumn('portfolio');
        });
    }
};
