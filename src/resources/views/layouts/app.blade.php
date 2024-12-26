<!DOCTYPEhtml>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air鍼灸院・整骨院</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
</head>

<body>
    <header>
        <div class="header__left">
            <div class="header__icon">
                <input id="drawer__input" class="drawer__hidden" type="checkbox">
                <label for="drawer__input" class="drawer__open"><img src="{{ asset('images/logo-icon.jpg') }}" alt="Air鍼灸院ロゴ" class="nav__icon"></label>
                <nav class="nav__content">
                    <ul class="nav__list">
                        @if(Auth::check())
                            <li class="nav__item"><a class="nav__item-link" href="{{ route('admin.results')}}">肌タイプ結果</a></li>
                            <li class="nav__item"><a class="nav__item-link" href="{{ route('admin.interview_results')}}">Health & Beauty 結果</a></li>
                            <li class="nav__item">
                                <form class="nav__item-link" action="/logout" method="post">
                                    @csrf
                                    <button class="nav__item-button">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav__item"><a class="nav__item-link" href="{{ route('index')}}">肌タイプ診断</a></li>
                            <li class="nav__item"><a class="nav__item-link" href="{{ route('interview.start')}}">Health & Beauty</a></li>
                            <li class="nav__item"><a class="nav__item-link" href="/register">管理者登録</a></li>
                            <li class="nav__item"><a class="nav__item-link" href="/login">管理者ログイン</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="header__logo">Air鍼灸院・整骨院</div>
        </div>
        @yield('header')
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>