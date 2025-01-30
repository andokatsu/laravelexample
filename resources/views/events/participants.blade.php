@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    参加者リスト
                    <a href="{{ route('events.exportCsv', $event->id) }}" class="btn btn-success btn-sm float-right">CSVエクスポート</a>
                </div>

                <div class="card-body">
                    @if ($participants->isEmpty())
                        <p>参加者はいません。</p>
                    @else
                        <ul>
                            @foreach ($participants as $participant)
                                <li>{{ $participant->name }} ({{ $participant->email }})</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection