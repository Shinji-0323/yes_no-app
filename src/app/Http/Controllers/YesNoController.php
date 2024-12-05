<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosis;

class YesNoController extends Controller
{
    public function index()
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

    public function results()
    {
        // 診断結果のマッピング
        $resultMapping = [
            'a1' => '普通肌',
            'a2' => '脂性肌',
            'a3' => '乾燥肌',
            'a4' => '混合肌',
        ];

        // セッションから診断結果を取得
        $gender = session('gender');
        $age = session('age');

        // 最新の診断結果を取得
        $result = Diagnosis::latest()->first();

        if (!$result) {
            return redirect()->route('index')->with('error', '診断結果が見つかりませんでした。');
        }

        // 診断結果を人間が読める形式に変換
        $readableResult = $resultMapping[$result->result] ?? '不明';

        // ビューにデータを渡す
        return view('results', compact('readableResult', 'gender', 'age'));
    }

    public function storeResult(Request $request)
    {
        // セッションから性別と年代を取得
        $gender = session('gender');
        $age = session('age');
        $result = $request->input('result'); // 診断結果を取得

        // データベースに保存
        Diagnosis::create([
            'gender' => $gender,
            'age' => $age,
            'result' => $result,
        ]);

        // 結果ページを表示（またはサンクスページ）
        return redirect()->route('results');
    }
}
