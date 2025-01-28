@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registration Successful') }}</div>

                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ __('ユーザー登録に成功しました。') }}
                    </div>
                    <a href="{{ route('welcome') }}" class="btn btn-primary">{{ __('ホームに戻る') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
