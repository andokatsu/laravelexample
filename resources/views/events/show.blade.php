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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection