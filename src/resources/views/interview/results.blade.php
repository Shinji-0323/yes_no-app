@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/interview/results.css') }}">
@endsection

@section('content')
    <div class="result-page">
        <h1 class="result-page__title">診断結果</h1>
        <div class="result-page__inner">
            <h2 class="answer__header">カテゴリごとの結果</h2>
            <p class="answer__count">美容: {{ $beautyCount }} 個</p>
            <p class="answer__count">生理: {{ $periodCount }} 個</p>
            <p class="answer__count">更年期: {{ $menopauseCount }} 個</p>
            <p class="answer__count">合計: {{ $totalCount }} 個</p>
        </div>
        <button class="result-page__actions">
            <a href="{{ route('interview.start') }}" class="result-page__btn">ホーム画面</a>
        </button>
    </div>
@endsection