@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/interview/index.css')}}">
@endsection

@section('content')
<div class="header__wrap">
        <div class="content__header">
            <h1 class="content__title">〜Health & Beauty〜</h1>
            <h2 class="content__text">自分を知るためのチェックシート</h2>
            <p class="text__note">{{ $category }}</p>
        </div>
    </div>
    <hr />
    <div class="content__wrap" id="main">
        <div class="question_area" id="question_area">
            @foreach ($questions as $index => $question)
                <p id="q{{ $index + 1 }}" class="{{ $index === 0 ? 'txt_display' : 'txt_hide' }}">
                    {{ $question }}
                </p>
            @endforeach
        </div>
        <div id="btn_area" class="txt_display">
            <button class="btn_yes" id="btn_yes">Yes</button>
            <button class="btn_no" id="btn_no">No</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const questions = @json($questions); // Bladeから質問を取得
            const yesAnswers = [];
            const totalQuestions = questions.length;
            let currentQuestion = 1;

            const btnYes = document.getElementById("btn_yes");
            const btnNo = document.getElementById("btn_no");

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
                    storeCategoryResult();
                }
            }

            function storeCategoryResult() {
                const yesCount = yesAnswers.length;

                fetch("{{ route('interview.result.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        category: '{{ $category }}', // 現在のカテゴリ
                        yesCount: yesCount
                    }),
                }).then(() => {
                    window.location.href = "{{ route('interview.next.category') }}";
                });
            }
        });
    </script>
@endsection