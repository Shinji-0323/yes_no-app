@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/auth.css') }}">
    <script src="https://kit.fontawesome.com/706e1a4697.js" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="auth__wrap">
        <div class="auth__header">
            管理者ログイン
        </div>
        <form class="form__item" action="/login" method="post">
            @csrf
            <div class="form__item-mail">
                <i class="fa-sharp fa-solid fa-envelope fa-2x"> <input type="email" class="form__input-item" name="email" placeholder="Email" value="{{ old('email') }}"></i>
            </div>
            <div class="error__item">
                @error('email')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__item-key">
                <i class="fa-solid fa-lock fa-2x"> <input type="password" class="form__input-item" name="password" placeholder="Password"></i>
            </div>
            <div class="error__item">
                @error('password')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="form__item-button">ログイン</button>
        </form>
    </div>
@endsection