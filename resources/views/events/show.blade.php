@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $event->title }}</div>

                <div class="card-body">
                    <p><strong>日程:</strong> {{ $event->date }}</p>
                    <p><strong>場所:</strong> {{ $event->location }}</p>
                    <p><strong>詳細:</strong> {{ $event->details }}</p>
                    <p><strong>定員:</strong> {{ $event->max_capacity }}</p>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($isRegistered)
                        <form method="POST" action="{{ route('events.cancel', $event->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">参加をキャンセル</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('events.register', $event->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">参加登録</button>
                        </form>
                    @endif

                    <a href="{{ route('events.participants', $event->id) }}" class="btn btn-secondary mt-3">参加者リスト</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
