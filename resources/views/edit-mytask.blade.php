<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>タスク編集 - {{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <h1>タスク編集</h1>
    <form action="{{ route('mytask.update', ['task' => $task->id]) }}" method="post">
        @csrf
        <label for="title">タスク名:</label>
        <input type="text" name="title" id="title" value="{{ $task->title }}" required>
        <button type="submit">更新</button>
    </form>
    <a href="{{ route('mytask.show') }}">戻る</a>
</body>
</html>