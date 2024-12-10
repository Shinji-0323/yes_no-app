@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/yes_no.css')}}">
@endsection

@section('content')
    <div class="start-page">
        <h1 class="start-page__title">肌タイプ診断</h1>
        <div class="start-page__inner">
            <p class="start-page__text">あなたにぴったりの肌タイプを診断しましょう。</p>
            <form class="start-page__form" action="{{ route('gender') }}" method="get">
                <button class="start-page__btn">診断を始める</button>
            </form>
        </div>
    </div>
@endsection