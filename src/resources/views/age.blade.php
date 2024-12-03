@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
    <div class="age-container">
        <h1>年代を選択してください</h1>
        <form action="{{ route('diagnosis') }}" method="post">
            @csrf
            <select name="age">
                <option value="10">10代</option>
                <option value="20">20代</option>
                <option value="30">30代</option>
                <option value="40">40代</option>
                <option value="50">50代以上</option>
            </select>
            <button type="submit">次へ</button>
        </form>
    </div>
@endsection