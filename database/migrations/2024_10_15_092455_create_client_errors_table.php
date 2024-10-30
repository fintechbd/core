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
        Schema::connection('support')->create('client_errors', function (Blueprint $table) {
            $table->id();
            $table->string('platform');
            $table->string('user_agent');
            $table->string('type')->nullable();
            $table->text('message');
            $table->string('file')->nullable();
            $table->integer('line')->nullable();
            $table->json('trace')->nullable();
            $table->string('timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('support')->dropIfExists('client_errors');
    }
};
