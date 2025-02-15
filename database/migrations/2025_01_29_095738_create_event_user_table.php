<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('event_user')) {
            Schema::create('event_user', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('event_id'); // 型を一致させる
                $table->unsignedInteger('user_id');  // 型を一致させる
                $table->timestamps();

                $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_user');
    }
}
