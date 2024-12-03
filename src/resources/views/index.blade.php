@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
    <div class="header__wrap">
        <div class="content__header">
            <div class="content__title">肌タイプ診断</div>
            <div class="content__text">〜あなたの本当の肌質がわかる！〜</div>
            <div class="text__note">4つのタイプ&使うべき化粧品がわかる!</div>
        </div>
    </div>
    <hr />
    <div class="content__wrap" id="main">
        <div class="question_area" id="question_area">
            <div id="q1" class="txt_display">朝起きたとき、肌が乾燥しているように感じる</div>
            <div id="q2" class="txt_hide">洗顔後、肌がつっぱるように感じる</div>
            <div id="q3" class="txt_hide">目や口の周りの肌が乾燥しやすいと感じる</div>
            <div id="q4" class="txt_hide">肌がベタついたりテカったりすることがある</div>
            <div id="q5" class="txt_hide">肌にかゆみやヒリつき、または敏感に感じる</div>
            <div id="q6" class="txt_hide">一部の箇所が乾燥し、一部の箇所が脂っぽく感じる</div>
            <div id="q7" class="txt_hide">毛穴の状態（黒ずみや開き）が気になる</div>
            <div id="q8" class="txt_hide">肌が全体的にテカリやすいと感じる</div>
            <div id="q9" class="txt_hide">肌のキメが細かく整っていると感じる</div>
        </div>
        <div class="answer__area">
            <div id="result_area" class="txt_hide">
                <div class="answer__header">あなたの肌タイプは……</div>
                <div id="a1" class="txt_hide">
                    <div class="answer__title">普通肌</div>
                    <div class="answer__detail">あなたの肌は、理想的なバランスを持つ普通肌です。</div>
                    <div class="answer__features"><strong>特徴:</strong> 水分量と皮脂量のバランスが良く、トラブルが少ない肌質。ただし、季節の変化や環境の影響で状態が揺らぐことがあります。</div>
                    <div class="answer__care"><strong>おすすめケア:</strong> 肌を守る保湿ケアを続け、バランスを崩さないように維持しましょう。</div>
                    <button class="answer__best">
                        <a href="{{ route('normal') }}">おすすめ保湿クリームを見る</a>
                    </button>
                </div>
                <div id="a2" class="txt_hide">
                    <div class="answer__title">脂性肌</div>
                    <div class="answer__detail">あなたの肌は、皮脂分泌が活発な脂性肌です。</div>
                    <div class="answer__features"><strong>特徴:</strong> 全体的にテカリやすく、毛穴が目立つことがあります。ニキビや吹き出物ができやすい傾向にあります。</div>
                    <div class="answer__care"><strong>おすすめケア:</strong> 皮脂をコントロールしつつ、保湿を欠かさないケアが必要です。</div>
                    <button class="answer__best">
                        <a href="{{ route('oily') }}">皮脂ケアにおすすめの商品を見る</a>
                    </button>
                </div>
                <div id="a3" class="txt_hide">
                    <div class="answer__title">乾燥肌</div>
                    <div class="answer__detail">あなたの肌は、水分量と皮脂量が少ない乾燥肌です。</div>
                    <div class="answer__features"><strong>特徴:</strong> 肌がカサつきやすく、小じわが目立ちやすい傾向にあります。刺激に弱い場合もあります。</div>
                    <div class="answer__care"><strong>おすすめケア:</strong> 高保湿のクリームや化粧水を使い、バリア機能を高めましょう。</div>
                    <button class="answer__best">
                        <a href="{{ route('dry') }}">乾燥肌におすすめの商品を見る</a>
                    </button>
                </div>
                <div id="a4" class="txt_hide">
                    <div class="answer__title">混合肌</div>
                    <div class="answer__detail">あなたの肌は、部位によって特性が異なる混合肌です。</div>
                    <div class="answer__features"><strong>特徴:</strong> Tゾーンは脂っぽく、Uゾーンは乾燥しやすい傾向にあります。ケア方法を部位ごとに変える必要があります。</div>
                    <div class="answer__care"><strong>おすすめケア:</strong> 部位ごとに異なるケアを行いましょう。Tゾーンは皮脂ケア、Uゾーンは保湿ケアを重点的に。</div>
                    <button class="answer__best">
                        <a href="{{ route('combo') }}">混合肌に最適なケア商品を見る</a>
                    </button>
                </div>
                <button class="answer__redo" id="restart" class="btn btn-secondary">もう1度診断する</button>
            </div>
        </div>
        <div id="btn_area" class="txt_display">
            <button class="btn_yes" id="btn_yes">Yes</button>
            <button class="btn_no" id="btn_no">No</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const qArray = ['q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9'];
            const results = {
                'a1': ['q1', 'q9'], // 普通肌
                'a2': ['q4', 'q7', 'q8'], // 脂性肌
                'a3': ['q1', 'q2', 'q3'], // 乾燥肌
                'a4': ['q5', 'q6', 'q8'], // 混合肌
            };

            let yesAnswers = [];
            let n = 0;

            const btnYes = document.getElementById('btn_yes');
            const btnNo = document.getElementById('btn_no');
            const restartBtn = document.getElementById('restart');

            btnYes.addEventListener('click', function () {
                console.log("Yes clicked");
                yesAnswers.push(qArray[n]);
                nextQuestion();
            });

            btnNo.addEventListener('click', function () {
                nextQuestion();
            });

            restartBtn.addEventListener('click', function () {
                yesAnswers = [];
                n = 0;

                document.querySelectorAll('.question_area div').forEach(div => {
                    div.classList.add('txt_hide');
                    div.classList.remove('txt_display');
                });

                document.getElementById(qArray[0]).classList.add('txt_display');
                document.getElementById(qArray[0]).classList.remove('txt_hide');

                // ボタンエリアを表示、結果エリアを非表示
                document.getElementById('btn_area').classList.add('txt_display');
                document.getElementById('btn_area').classList.remove('txt_hide');
                document.getElementById('result_area').classList.add('txt_hide');
                document.getElementById('result_area').classList.remove('txt_display');
            });

            function nextQuestion() {
                document.getElementById(qArray[n]).classList.add('txt_hide');
                document.getElementById(qArray[n]).classList.remove('txt_display');

                n++;
                if (n < qArray.length) {
                    document.getElementById(qArray[n]).classList.add('txt_display');
                    document.getElementById(qArray[n]).classList.remove('txt_hide');
                } else {
                    showResult();
                }
            }

            function showResult() {
                document.getElementById('btn_area').classList.add('txt_hide');
                document.getElementById('btn_area').classList.remove('txt_display');
                document.getElementById('result_area').classList.add('txt_display');
                document.getElementById('result_area').classList.remove('txt_hide');

                const result = determineResult();
                document.getElementById(result).classList.add('txt_display');
                document.getElementById(result).classList.remove('txt_hide');
            }

            function determineResult() {
                const scores = {};
                for (let result in results) {
                    scores[result] = results[result].filter(question => yesAnswers.includes(question)).length;
                }

                const maxScore = Math.max(...Object.values(scores)); // 最大スコアを取得
                const bestMatches = Object.keys(scores).filter(key => scores[key] === maxScore); // 最大スコアを持つ結果を取得

                // 結果が複数ある場合は、最初の結果を選択する
                return bestMatches[0];
            }
        });
    </script>
@endsection
