<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id'); // IDフィールド
            $table->string('title'); // イベントタイトル
            $table->date('date')->nullable(); // イベント日程をnullableに設定
            $table->string('location'); // イベント場所
            $table->text('details'); // イベント詳細
            $table->unsignedBigInteger('organizer_id'); // 主催者ID（unsignedBigIntegerを使用）
            $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade'); // 外部キー制約
            $table->integer('max_capacity'); // 定員
            $table->integer('current_capacity')->default(0); // 登録人数
            $table->timestamps(); // 作成日時・更新日時
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
