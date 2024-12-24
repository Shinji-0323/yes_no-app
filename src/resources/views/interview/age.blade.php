@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/interview/interview.css')}}">
@endsection

@section('content')
    <div class="age-page">
        <h1 class="age-page__title">年齢を入力してください</h1>
        <div class="age-page__inner">
            <form class="age-page__form" action="{{ route('interview') }}" method="post">
                @csrf
                <input class="age-page__input" type="number" name="age" placeholder="例:25" value="{{ old('age') }}" min="1" max="120">
                <div class="contact-form__error-message">
                    @if ($errors->has('age'))
                        <p class="contact-form__error-message-age">{{ $errors->first('age') }}</p>
                    @endif
                </div>
                <button class="age-page__btn" type="submit">次へ</button>
            </form>
        </div>
    </div>
@endsection