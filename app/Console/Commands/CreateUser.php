<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class CreateUser extends Command
{
    // コマンドの署名と引数の設定
    protected $signature = 'make:user {name} {email} {password}';

    // コマンドの説明
    protected $description = 'Create a new user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // App\User モデルを使って新しいユーザーを作成
        $user = new \App\User(); // モデルのパスを適宜変更
        $user->name = $this->argument('name'); // 引数から名前を取得
        $user->email = $this->argument('email'); // 引数からメールアドレスを取得
        $user->password = bcrypt($this->argument('password')); // パスワードをハッシュ化
        $user->role = 'user'; // 必要に応じて役割を指定
        $user->save();

        $this->info('User created successfully!');
    }
}

