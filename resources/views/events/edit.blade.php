<form action="{{ route('events.update', $event->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="title">イベント編集</label>
    <input type="text" id="title" name="title" value="{{ $event->title }}" required>

    <label for="date">日程</label>
    <input type="date" id="date" name="date" value="{{ $event->date }}" required>

    <label for="location">場所</label>
    <input type="text" id="location" name="location" value="{{ $event->location }}" required>

    <label for="details">詳細</label>
    <textarea id="details" name="details" required>{{ $event->details }}</textarea>

    <label for="max_capacity">定員</label>
    <input type="number" id="max_capacity" name="max_capacity" value="{{ $event->max_capacity }}" required>

    <button type="submit">更新</button>
</form>
