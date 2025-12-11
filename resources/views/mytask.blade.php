<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    </head>
    <body class="antialiased">
        <h1>タスクアプリ</h1>
        <div>
            <ul>
                @foreach ($tasks as $task)
                    <li>{{ $task->title }}</li>
                    <form action="{{ route('mytask.edit', ['id' => $task->id]) }}" method="get">
                        @csrf
                        <button type="submit">編集</button>
                    </form> 
                    <form action="{{ route('mytask.destroy', ['id' => $task->id]) }}" method="post">
                        @csrf
                        <button type="submit">削除</button>
                    </form> 
                @endforeach
            </ul>
        </div>
        <div>
            <p>🔽 タスクを追加 🔽
            <form action="{{ route('mytask.create') }}" method="post">
                @csrf
                <textarea name="title" id="task-title"></textarea>
                <button type="submit">追加</button>
                @error('title')
                <p>{{ $message }}</p>
                @enderror
    </body>
</html>
