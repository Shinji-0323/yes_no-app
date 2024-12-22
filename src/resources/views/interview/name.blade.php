@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/interview/interview.css')}}">
@endsection

@section('content')
    <div class="name-page">
        <h1 class="name-page__title">名前を入力してください</h1>
        <div class="name-page__inner">
            <form class="name-page__form" action="{{ route('interview.age') }}" method="post">
                @csrf
                <div class="contact-form__name-inputs">
                    <input class="contact-form__input contact-form__name-input" type="text" name="name" id="name"
                    value="{{ old('name') }}" placeholder="例：山田 花子">
                </div>
                <div class="contact-form__error-message">
                    @if ($errors->has('name'))
                    <p class="contact-form__error-message-name">{{$errors->first('name')}}</p>
                    @endif
                </div>
                <button class="name-page__btn" type="submit">決定</button>
            </form>
        </div>
    </div>
@endsection