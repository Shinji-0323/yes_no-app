@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
    <div class="start-container">
        <h1>肌タイプ診断</h1>
        <p>あなたにぴったりの肌タイプを診断しましょう。</p>
        <button onclick="location.href='{{ route('gender') }}'">診断を始める</button>
    </div>
@endsection