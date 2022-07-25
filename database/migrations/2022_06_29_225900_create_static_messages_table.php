<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_messages', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->enum('type', ['info', 'error', 'warning', 'success']);
            $table->enum('state', ['off', 'on'])->default('on');
            $table->date('show_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('static_messages');
    }
};
