@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Organizer Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>ようこそ、{{ Auth::user()->name }}さん！</h1>
                    <a href="{{ route('events.index') }}" class="btn btn-primary mt-3">イベント一覧</a>
                    <a href="{{ route('events.create') }}" class="btn btn-primary mt-3">新規イベント作成</a>
                    <a href="{{ route('events.calendar') }}" class="btn btn-primary mt-3">イベントカレンダー</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
