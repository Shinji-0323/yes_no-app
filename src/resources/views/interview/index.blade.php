@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/interview/index.css')}}">
@endsection

@section('content')
<div class="header__wrap">
        <div class="content__header">
            <h1 class="content__title">〜Health & Beauty〜</h1>
            <h2 class="content__text">自分を知るためのチェックシート</h2>
            <p class="text__note">美容</p>
        </div>
    </div>
    <hr />
    <div class="content__wrap" id="main">
        <div class="question_area" id="question_area">
            <p id="q1" class="txt_display">おまたを鏡で見たことがない</p>
            <p id="q2" class="txt_hide">VIO脱毛をしていない</p>
            <p id="q3" class="txt_hide">保湿を行っていない</p>
            <p id="q4" class="txt_hide">黒ずみが気になる</p>
            <p id="q5" class="txt_hide">ニオイやかゆみが気になる</p>
            <p id="q6" class="txt_hide">おりものシートを常時使用している</p>
            <p id="q7" class="txt_hide">食事（特に朝食）を抜くことが多い</p>
            <p id="q8" class="txt_hide">便秘だ（3日以上出ないことがよくある）</p>
            <p id="q9" class="txt_hide">浮腫みやすい</p>
            <p id="q10" class="txt_hide">入浴は週に3回以下である</p>
        </div>
        <div id="btn_area" class="txt_display">
            <button class="btn_yes" id="btn_yes">Yes</button>
            <button class="btn_no" id="btn_no">No</button>
        </div>
        <div class="answer__area">
            <div id="result_area" class="txt_hide">
                <form id="result-form" action="{{ route('interview.result.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="name" value="{{ session('name') }}">
                    <input type="hidden" name="age" value="{{ session('age') }}">
                    <input type="hidden" name="result" id="interview_result">
                    <button class="answer__check" type="submit">結果を確認</button>
                </form>
                <button id="restart"  class="answer__redo">もう1度診断する</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const yesAnswers = [];
            const totalQuestions = 10; // 質問の総数
            let currentQuestion = 1;

            const btnYes = document.getElementById("btn_yes");
            const btnNo = document.getElementById("btn_no");
            const questionArea = document.getElementById("question_area");
            const resultArea = document.getElementById("result_area");
            const resultForm = document.getElementById("result-form");
            const resultInput = document.getElementById("interview_result");

            btnYes.addEventListener("click", function () {
                yesAnswers.push(currentQuestion);
                nextQuestion();
            });

            btnNo.addEventListener("click", function () {
                nextQuestion();
            });

            function nextQuestion() {
                const currentQuestionElement = document.getElementById(`q${currentQuestion}`);
                currentQuestionElement.classList.add("txt_hide");
                currentQuestionElement.classList.remove("txt_display");

                currentQuestion++;
                if (currentQuestion <= totalQuestions) {
                    const nextQuestionElement = document.getElementById(`q${currentQuestion}`);
                    nextQuestionElement.classList.add("txt_display");
                    nextQuestionElement.classList.remove("txt_hide");
                } else {
                    showResult();
                }
            }

            function showResult() {
                // Yes/Noボタンを非表示にする
                document.getElementById('btn_area').classList.add('txt_hide');
                document.getElementById('btn_area').classList.remove('txt_display');

                // 結果エリアを表示する
                document.getElementById('result_area').classList.add('txt_display');
                document.getElementById('result_area').classList.remove('txt_hide');

                // Yesの回答数をカウントし、結果フォームに設定
                const yesCount = yesAnswers.length; // Yesの数をカウント
                document.getElementById('interview_result').value = yesCount;
            }
        });
    </script>
@endsection