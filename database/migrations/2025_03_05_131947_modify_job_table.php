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
            $table->dropColumn('queue');
            $table->dropColumn('attempts');
            $table->dropColumn('reserved_at');
            $table->dropColumn('available_at');

            $table->string('name')->after('id');
            $table->string('content')->after('name');
            $table->string('status')->default('1')->after('content');
            $table->string('address')->after('status');
            $table->unsignedBigInteger('company')->after('address');
            $table->unsignedInteger('salary')->after('company');
            $table->string('type')->after('salary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
            $table->string('queue')->nullable();
            $table->unsignedTinyInteger('attempts')->nullable();
            $table->timestamp('reserved_at')->nullable();
            $table->timestamp('available_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
        
        });
    }
};
