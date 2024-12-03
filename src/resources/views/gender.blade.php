@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
    <div class="gender-container">
        <h1>性別を選択してください</h1>
        <form action="{{ route('age') }}" method="post">
            @csrf
            <button type="submit" name="gender" value="male">男性</button>
            <button type="submit" name="gender" value="female">女性</button>
        </form>
    </div>
@endsection