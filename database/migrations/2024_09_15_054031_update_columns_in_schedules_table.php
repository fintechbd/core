<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::connection('support')->hasColumn('schedules', 'schedule_data')) {
            Schema::connection('support')->table('schedules', function (Blueprint $table) {
                $table->json('schedule_data')->nullable()->after('enabled');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::connection('support')->hasColumn('schedules', 'schedule_data')) {
            Schema::connection('support')->table('schedules', function (Blueprint $table) {
                $table->dropColumn('schedule_data');
            });
        }
    }
};
