@extends('layouts.app')

@section('content')
<div class="admin-container">
    <h1>診断結果一覧</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>性別</th>
                <th>年代</th>
                <th>結果</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{ $result->id }}</td>
                <td>{{ $result->gender }}</td>
                <td>{{ $result->age }}</td>
                <td>{{ $result->result }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection