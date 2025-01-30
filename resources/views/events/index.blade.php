@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">イベント一覧</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">新規イベント作成</a>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">戻る</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>タイトル</th>
                                <th>日程</th>
                                <th>場所</th>
                                <th>定員</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->date }}</td>
                                    <td>{{ $event->location }}</td>
                                    <td>{{ $event->max_capacity }}</td>
                                    <td>
                                        <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">編集</a>
                                        <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
