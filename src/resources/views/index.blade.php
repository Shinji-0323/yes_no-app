@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
    <div class="header__wrap">
        <div class="content__header">
            <h1 class="content__title">肌タイプ診断</h1>
            <h2 class="content__text">〜あなたの本当の肌質がわかる！〜</h2>
            <p class="text__note">4つのタイプ&使うべき化粧品がわかる!</p>
        </div>
    </div>
    <hr />
    <div class="content__wrap" id="main">
        <div class="question_area" id="question_area">
            <p id="q1" class="txt_display">朝起きたとき、肌が乾燥しているように感じる</p>
            <p id="q2" class="txt_hide">洗顔後、肌がつっぱるように感じる</p>
            <p id="q3" class="txt_hide">目や口の周りの肌が乾燥しやすいと感じる</p>
            <p id="q4" class="txt_hide">肌がベタついたりテカったりすることがある</p>
            <p id="q5" class="txt_hide">肌にかゆみやヒリつき、または敏感に感じる</p>
            <p id="q6" class="txt_hide">一部の箇所が乾燥し、一部の箇所が脂っぽく感じる</p>
            <p id="q7" class="txt_hide">毛穴の状態（黒ずみや開き）が気になる</p>
            <p id="q8" class="txt_hide">肌が全体的にテカリやすいと感じる</p>
            <p id="q9" class="txt_hide">肌のキメが細かく整っていると感じる</p>
        </div>
        <div id="btn_area" class="txt_display">
            <button class="btn_yes" id="btn_yes">Yes</button>
            <button class="btn_no" id="btn_no">No</button>
        </div>
        <div class="answer__area">
            <div id="result_area" class="txt_hide">
                <form id="result-form" action="{{ route('result.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="gender" value="{{ session('gender') }}">
                    <input type="hidden" name="age" value="{{ session('age') }}">
                    <input type="hidden" name="result" id="diagnosis_result">
                    <button class="answer__check" type="submit">結果を確認</button>
                </form>
                <button id="restart"  class="answer__redo">もう1度診断する</button>
            </div>
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
                yesAnswers.push(qArray[n]);
                nextQuestion();
            });

            btnNo.addEventListener('click', function () {
                nextQuestion();
            });

            restartBtn.addEventListener('click', function () {
                yesAnswers = [];
                n = 0;
                resetQuiz();
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

                const results = determineResult(); // 配列で結果を取得
                const diagnosisResult = results.join(','); // カンマで区切って文字列に変換
                document.getElementById('diagnosis_result').value = diagnosisResult;
            }

            function determineResult() {
                const scores = {};
                for (let result in results) {
                    scores[result] = results[result].filter(q => yesAnswers.includes(q)).length;
                }

                // 最大スコアを計算
                const maxScore = Math.max(...Object.values(scores));

                // 最大スコアに該当するすべての結果を返す
                const matchedResults = Object.keys(scores).filter(key => scores[key] === maxScore);

                // 結果が存在しない場合の対応
                return matchedResults.length > 0 ? matchedResults : ['診断結果が判定できません'];
                }

            function resetQuiz() {
                // 質問の表示をリセット
                qArray.forEach((id, index) => {
                    const element = document.getElementById(id);
                    if (index === 0) {
                        element.classList.add('txt_display');
                        element.classList.remove('txt_hide');
                    } else {
                        element.classList.add('txt_hide');
                        element.classList.remove('txt_display');
                    }
                });

                // ボタンエリアを再表示
                document.getElementById('btn_area').classList.add('txt_display');
                document.getElementById('btn_area').classList.remove('txt_hide');

                // 結果エリアを非表示
                document.getElementById('result_area').classList.add('txt_hide');
                document.getElementById('result_area').classList.remove('txt_display');
            }
        });
    </script>
@endsection
