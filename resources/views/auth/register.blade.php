<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>新規登録 - {{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <h1>新規登録</h1>
    <form method="post" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" required>
            @error('password')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password_confirmation">パスワード（確認）</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <button type="submit">登録</button>
    </form>
    <p><a href="{{ route('login') }}">ログインはこちら</a></p>
</body>
</html>

