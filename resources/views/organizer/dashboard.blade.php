@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Organizer Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>ようこそ、{{ Auth::user()->name }}さん！</h1>
                    <a href="{{ route('events.calendar') }}" class="btn btn-primary mt-3">イベントカレンダー</a>
                    <a href="{{ route('events.create') }}" class="btn btn-success mt-3">イベント作成</a>
                    <a href="{{ route('events.index') }}" class="btn btn-info mt-3">イベント一覧</a>

                    <h5 class="mt-4">統計情報</h5>
                    <ul>
                        <li>総イベント数: {{ $totalEvents }}</li>
                        <li>総参加者数: {{ $totalParticipants }}</li>
                        <li>総キャンセル数: {{ $totalCancellations }}</li>
                    </ul>

                    <h5>人気のイベント</h5>
                    <ul>
                        @foreach ($popularEvents as $event)
                            <li>{{ $event->title }} - 参加者数: {{ $event->users_count }}</li>
                        @endforeach
                    </ul>

                    <h5 class="mt-4">イベント一覧</h5>
                    <ul>
                        @foreach ($events as $event)
                            <li>{{ $event->title }} - {{ $event->date }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
