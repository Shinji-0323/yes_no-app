@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/interview/interview.css')}}">
@endsection

@section('content')
    <div class="start-page">
        <h1 class="start-page__title">Health & Beauty</h1>
        <div class="start-page__inner">
            <p class="start-page__text">これから<span>美容・生理・更年期</span>の3項目についてお答えください</p>
            <form class="start-page__form" action="{{ route('interview.name') }}" method="get">
                <button class="start-page__btn">診断を始める</button>
            </form>
        </div>
    </div>
@endsection