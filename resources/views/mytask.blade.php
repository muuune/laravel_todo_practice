<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TODO - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    </head>
    <body class="antialiased">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>タスクアプリ</h1>
            <div>
                @auth
                    <span>{{ auth()->user()->name }} さん</span>
                    <form action="{{ route('logout') }}" method="post" style="display: inline;">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                @endauth
            </div>
        </div>
        <form action="{{ route('mytask.show') }}" method="get">
            <select name="filter_status" onChange="this.form.submit()">
                <option value="">全て</option>
                <option value="0" {{ request('filter_status') === '0' ? 'selected' : '' }}>未完了</option>
                <option value="1" {{ request('filter_status') === '1' ? 'selected' : '' }}>完了</option>
            </select>
            <div>
                <input type="text" name="search" placeholder="タスク名で検索" value="{{ request('search') }}" />
                <button type="submit">検索</button>
            </div>
            <div>
                <label>並び替え: </label>
                <select name="sort" onchange="this.form.submit()">
                    <option value="">-- 並び替え選択 --</option>
                    <option value="title_asc" {{ request('sort') === 'title_asc' ? 'selected' : '' }}>タスク名昇順(A→Z)</option>
                    <option value="title_desc" {{ request('sort') === 'title_desc' ? 'selected' : '' }}>タスク名降順(Z→A)</option>
                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>登録順（新→古）</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>登録順（古→新）</option>
                </select>
            </div>
        </form>
        <div>
            <ul>
                @foreach ($tasks as $task)
                    <form action="{{ route('mytask.updateStatus', ['id' => $task->id]) }}" method="post">
                        @csrf
                        <input type="checkbox"
                        name="status"
                        {{ $task->status ? 'checked' : '' }}
                        onChange="this.form.submit()">
                        {{ $task->title }}
                    </form>
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
