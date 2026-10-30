<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tracker', function (Blueprint $table) {
            $table->string('method', 10)->default('GET')->after('ip');
            $table->string('route_name', 100)->nullable()->after('method');
            $table->json('meta')->nullable()->after('status');
            $table->index('route_name');
        });
    }

    public function down(): void
    {
        Schema::table('tracker', function (Blueprint $table) {
            $table->dropIndex(['route_name']);
            $table->dropColumn(['method', 'route_name', 'meta']);
        });
    }
};
