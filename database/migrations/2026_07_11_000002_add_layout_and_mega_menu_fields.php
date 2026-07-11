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
        Schema::table('blocks', function (Blueprint $table) {
            $table->string('layout_variant')->default('standard')->after('type');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->string('menu_type')->default('standard')->after('location');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->boolean('is_mega_menu')->default(false)->after('url');
            $table->text('mega_menu_content')->nullable()->after('is_mega_menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropColumn('layout_variant');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('menu_type');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn(['is_mega_menu', 'mega_menu_content']);
        });
    }
};
