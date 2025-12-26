<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ログイン - {{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <h1>ログイン</h1>
    <form method="post" action="{{ route('login') }}">
        @csrf
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
            <label>
                <input type="checkbox" name="remember"> ログイン状態を保持する
            </label>
        </div>
        <button type="submit">ログイン</button>
    </form>
    <p><a href="{{ route('register') }}">新規登録はこちら</a></p>
</body>
</html>

