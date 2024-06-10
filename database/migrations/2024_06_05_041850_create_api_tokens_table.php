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
        Schema::create('api_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('token', 40);
            $table->float('time')->default(0);
            $table->float('price')->default(0.0015);
            $table->float('total')->storedAs('`price` * `time`');
            $table->float('limit')->default(7.5);
            $table->foreignId('workspace_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('revoked_at')->nullable();
            $table->index('created_at');
            $table->index('revoked_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_tokens');
    }
};
