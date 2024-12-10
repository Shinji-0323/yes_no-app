@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/product.css')}}">
@endsection

@section('content')
    <div class="item__wrap">
        <div class="item__header">
            <h1 class="header__title">普通肌におすすめの商品</h1>
        </div>
        <div class="item__detail">
            <p class="item__title">※ここに普通肌用の商品情報を記載してください。※</p>
        </div>
        <button class="result-page__actions">
            <a href="{{ route('index') }}" class="result-page__btn">ホーム画面</a>
        </button>
    </div>
@endsection