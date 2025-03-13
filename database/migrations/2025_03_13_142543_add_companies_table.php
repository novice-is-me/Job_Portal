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
        Schema::create('companies', function (Blueprint $table) {
            //
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('email');
            $table->string('image');
            $table->string('address');
            $table->unsignedInteger('no_employees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop the table if it exists
        Schema::dropIfExists('companies');
    }
};
