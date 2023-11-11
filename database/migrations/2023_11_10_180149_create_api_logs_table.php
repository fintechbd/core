<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            $table->string('direction')->default(\Fintech\Core\Enums\ApiDirectionEnum::InBound->value);
            $table->foreignId('user_id')->nullable();
            $table->string('method')->nullable();
            $table->string('host');
            $table->text('url');
            $table->string('type')->nullable();
            $table->mediumInteger('status_code')->nullable();
            $table->string('status_text')->nullable();
            $table->longText('request')->nullable();
            $table->longText('response')->nullable();
            $table->longText('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_logs');
    }
};
