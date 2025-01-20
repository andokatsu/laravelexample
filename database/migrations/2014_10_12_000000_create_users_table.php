<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');// ユーザーID
            $table->string('name');// ユーザー名
            $table->string('email')->unique();// メールアドレス（ユニーク）
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');// パスワード
            $table->rememberToken();
            $table->timestamps();// 作成日時と更新日時
            $table->string('role')->default('user'); // ロール（デフォルトは一般ユーザー）
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
