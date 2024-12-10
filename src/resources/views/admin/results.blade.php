@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/results.css')}}">
@endsection

@section('content')
    <div class="header-wrap">
        <h1 class="admin__title">診断結果一覧</h1>
        <div class="export-form">
            <form action="{{ route('admin.results.csv') }}" method="get">
                @csrf
                <input class="export__btn btn" type="submit" value="エクスポート">
            </form>
        </div>
    </div>
    <div class="table__wrap">
        <table class="skin-age__table">
            <tr class="table__row">
                <th class="table__header">ID</th>
                <th class="table__header">性別</th>
                <th class="table__header">年代</th>
                <th class="table__header">結果</th>
            </tr>
            @foreach($diagnoses as $diagnosis)
            <tr class="table__row">
                <td class="table__item">{{ $diagnosis['id'] }}</td>
                <td class="table__item">{{ $diagnosis['gender'] }}</td>
                <td class="table__item">{{ $diagnosis['age'] }}代</td>
                <td class="table__item">{{ $diagnosis['result'] }}</td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection