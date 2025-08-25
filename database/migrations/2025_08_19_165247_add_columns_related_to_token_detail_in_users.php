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
            $table->string(column: 'access_token')->nullable()->after(column:'password');
            $table->string(column: 'refresh_token')->nullable()->after(column:'access_token');
            $table->string(column: 'expires_in')->nullable()->after(column:'refresh_token');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(column:'access_token');
            $table->dropColumn(column:'refresh_token');
            $table->dropColumn(column:'expires_in');
        });
    }
};
