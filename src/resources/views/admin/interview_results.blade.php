@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/interview_results.css')}}">
@endsection

@section('content')
    <div class="header-wrap">
        <h1 class="admin__title">診断結果一覧</h1>
        <div class="export-form">
            <form action="{{ route('admin.interview_results.csv') }}" method="get">
                @csrf
                <input class="export__btn btn" type="submit" value="エクスポート">
            </form>
        </div>
    </div>
    <div class="table__wrap">
        <table class="skin-age__table">
            <tr class="table__row">
                <th class="table__header">ID</th>
                <th class="table__header name">名前</th>
                <th class="table__header">年齢</th>
                <th class="table__header">美容</th>
                <th class="table__header">生理</th>
                <th class="table__header">更年期</th>
                <th class="table__header">合計</th>
            </tr>
            @foreach($interviews as $interview)
            <tr class="table__row">
                <td class="table__item">{{ $interview->id }}</td>
                <td class="table__item">{{ $interview->name }}</td>
                <td class="table__item">{{ $interview->age }}</td>
                <td class="table__item">{{ $interview->beauty_count }}</td>
                <td class="table__item">{{ $interview->period_count }}</td>
                <td class="table__item">{{ $interview->menopause_count }}</td>
                <td class="table__item">{{ $interview->total_count }}</td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection