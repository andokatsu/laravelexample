@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">イベント編集</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('events.update', $event) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="date">日程</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date', $event->date) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="location">場所</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location', $event->location) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="details">詳細</label>
                            <textarea name="details" class="form-control" required>{{ old('details', $event->details) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="max_capacity">定員</label>
                            <input type="number" name="max_capacity" class="form-control" value="{{ old('max_capacity', $event->max_capacity) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
