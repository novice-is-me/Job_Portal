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
            $table->integer('age')->after('email')->nullable();
            $table->string('address')->after('age')->nullable();
            $table->string('phone')->after('address')->nullable();
            $table->string('resume')->after('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('age');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('resume');
        });
    }
};
