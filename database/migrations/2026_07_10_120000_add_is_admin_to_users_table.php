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
        // add the is_admin flag so we can separate admins from regular users
        Schema::table('users', function (Blueprint $table) {
            // defaults to false so existing users stay non-admin
            $table->boolean('is_admin')->default(false)->after('password');
        });
    }

    public function down(): void
    {
        // remove the column when rolling back this migration
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
};
