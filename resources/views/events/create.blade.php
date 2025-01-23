<!-- resources/views/events/create.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>イベント作成</title>
</head>
<body>
    <h1>新しいイベントを作成</h1>

    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <label for="title">イベントタイトル</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="date">日程</label>
        <input type="date" name="date" id="date" required><br><br>

        <label for="location">場所</label>
        <input type="text" name="location" id="location" required><br><br>

        <label for="details">詳細</label>
        <textarea name="details" id="details" required></textarea><br><br>

        <label for="max_capacity">定員</label>
        <input type="number" name="max_capacity" id="max_capacity" required><br><br>

        <button type="submit">作成</button>
    </form>
</body>
</html>
