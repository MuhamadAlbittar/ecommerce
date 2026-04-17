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
<<<<<<<< HEAD:database/migrations/2026_03_23_033704_add_cullom_to_categories_table.php
        Schema::table('categories', function (Blueprint $table) {
               $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
               $table->unsignedBigInteger('added_by')->nullable()->after('id');
========
        Schema::table('users', function (Blueprint $table) {
            //
>>>>>>>> bf65779e33ca87f430c62f628aa3f13fc601c8e4:database/migrations/2026_03_25_132127_add_role_to_users_table.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<<< HEAD:database/migrations/2026_03_23_033704_add_cullom_to_categories_table.php
        Schema::table('categories', function (Blueprint $table) {
========
        Schema::table('users', function (Blueprint $table) {
>>>>>>>> bf65779e33ca87f430c62f628aa3f13fc601c8e4:database/migrations/2026_03_25_132127_add_role_to_users_table.php
            //
        });
    }
};
