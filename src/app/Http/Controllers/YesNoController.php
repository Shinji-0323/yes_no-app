<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YesNoController extends Controller
{
    public function start()
    {
        return view('start');
    }

    public function gender()
    {
        return view('gender');
    }

    public function age(Request $request)
    {
        session(['gender' => $request->gender]); // 性別をセッションに保存
        return view('age');
    }

    public function diagnosis(Request $request)
    {
        session(['age' => $request->age]); // 年代をセッションに保存
        return view('index'); // 診断のYes/Noページ
    }

    public function index()
    {
        return view('index');
    }
}
