<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('thread_id')->nullable(false);
            $table->uuid('sender_id')->nullable(false);
            $table->uuid('receiver_id')->nullable();
            $table->timestamp('time_send')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('content')->nullable(false);
            $table->boolean('readed')->default(false);
            $table->timestamp('time_read')->nullable();

            $table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
