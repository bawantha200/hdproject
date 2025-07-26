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
            $table->string('first_name')->after('id');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone')->after('last_name');
            $table->string('address')->after('phone');
            
            // Remove the old 'name' field if it exists
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add back the 'name' field if rolling back
            $table->string('name')->after('id');
            
            // Remove the new fields
            $table->dropColumn(['first_name', 'last_name', 'phone', 'address']);
        });
    }
};