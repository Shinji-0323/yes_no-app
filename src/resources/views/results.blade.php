@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/results.css') }}">
@endsection

@section('content')
    <div class="result-page">
        <h1 class="result-page__title">診断結果</h1>
        <div class="result-page__inner">
            <h2 class="answer__header">あなたの肌タイプは……</h2>
            @foreach ($readableResults as $result)
                <div class="answer__section">
                    <h3 class="answer__title">{{ $result }}</h3>
                    @if ($result === '普通肌')
                        <p class="answer__detail">あなたの肌は、理想的なバランスを持つ普通肌です。</p>
                        <p class="answer__features"><strong>特徴:</strong> 水分量と皮脂量のバランスが良く、トラブルが少ない肌質。ただし、季節の変化や環境の影響で状態が揺らぐことがあります。</p>
                        <p class="answer__care"><strong>おすすめケア:</strong> 肌を守る保湿ケアを続け、バランスを崩さないように維持しましょう。</p>
                        <button class="answer__best">
                            <a class="answer__best__button" href="{{ route('normal') }}">おすすめ保湿クリームを見る</a>
                        </button>
                    @elseif ($result === '脂性肌')
                        <p class="answer__detail">あなたの肌は、皮脂分泌が活発な脂性肌です。</p>
                        <p class="answer__features"><strong>特徴:</strong> 全体的にテカリやすく、毛穴が目立つことがあります。ニキビや吹き出物ができやすい傾向にあります。</p>
                        <p class="answer__care"><strong>おすすめケア:</strong> 皮脂をコントロールしつつ、保湿を欠かさないケアが必要です。</p>
                        <button class="answer__best">
                            <a class="answer__best__button" href="{{ route('oily') }}">皮脂ケアにおすすめの商品を見る</a>
                        </button>
                    @elseif ($result === '乾燥肌')
                        <p class="answer__detail">あなたの肌は、水分量と皮脂量が少ない乾燥肌です。</p>
                        <p class="answer__features"><strong>特徴:</strong> 肌がカサつきやすく、小じわが目立ちやすい傾向にあります。刺激に弱い場合もあります。</p>
                        <p class="answer__care"><strong>おすすめケア:</strong> 高保湿のクリームや化粧水を使い、バリア機能を高めましょう。</p>
                        <button class="answer__best">
                            <a class="answer__best__button" href="{{ route('dry') }}">乾燥肌におすすめの商品を見る</a>
                        </button>
                    @elseif ($result === '混合肌')
                        <p class="answer__detail">あなたの肌は、部位によって特性が異なる混合肌です。</p>
                        <p class="answer__features"><strong>特徴:</strong> Tゾーンは脂っぽく、Uゾーンは乾燥しやすい傾向にあります。ケア方法を部位ごとに変える必要があります。</p>
                        <p class="answer__care"><strong>おすすめケア:</strong> 部位ごとに異なるケアを行いましょう。Tゾーンは皮脂ケア、Uゾーンは保湿ケアを重点的に。</p>
                        <button class="answer__best">
                            <a class="answer__best__button" href="{{ route('combo') }}">混合肌に最適なケア商品を見る</a>
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
        <button class="result-page__actions">
            <a href="{{ route('index') }}" class="result-page__btn">ホーム画面</a>
        </button>
    </div>
@endsection