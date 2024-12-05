@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/yes_no.css')}}">
@endsection

@section('content')
    <div class="age-page">
        <h1 class="age-page__title">年代を選択してください</h1>
        <div class="age-page__inner">
            <form class="age-page__form" action="{{ route('diagnosis') }}" method="post">
                @csrf
                <select class="age-page__select" name="age">
                    <option value="10">10代</option>
                    <option value="20">20代</option>
                    <option value="30">30代</option>
                    <option value="40">40代</option>
                    <option value="50">50代以上</option>
                </select>
                <button class="age-page__btn" type="submit">次へ</button>
            </form>
        </div>
    </div>
@endsection