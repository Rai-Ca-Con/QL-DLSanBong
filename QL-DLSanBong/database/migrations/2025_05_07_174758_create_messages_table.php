<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('thread_id', 36)->nullable(false);
            $table->char('sender_id', 36)->nullable(false);
            $table->char('receiver_id', 36)->nullable();
            $table->datetime('time_send')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('content')->nullable(false);
            $table->boolean('readed')->default(false);
            $table->datetime('time_read')->nullable();

            $table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
