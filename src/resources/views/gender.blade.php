@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/yes_no.css')}}">
@endsection

@section('content')
    <div class="gender-page">
        <h1 class="gender-page__title">性別を選択してください</h1>
        <div class="gender-page__inner">
            <form class="gender-page__form" action="{{ route('age') }}" method="post">
                @csrf
                <button class="gender-page__btn male" type="submit" name="gender" value="male">男性</button>
                <button class="gender-page__btn female" type="submit" name="gender" value="female">女性</button>
            </form>
        </div>
    </div>
@endsection