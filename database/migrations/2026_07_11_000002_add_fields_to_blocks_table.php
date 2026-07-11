<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blocks', function (Blueprint $table) {
            if (!Schema::hasColumn('blocks', 'title')) {
                $table->string('title')->after('id');
            }
            if (!Schema::hasColumn('blocks', 'json_data')) {
                $table->json('json_data')->nullable()->after('content');
            }
            if (!Schema::hasColumn('blocks', 'order')) {
                $table->integer('order')->default(0)->after('padding');
            }
        });
    }

    public function down(): void
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropColumn(['title', 'json_data', 'order']);
        });
    }
};
