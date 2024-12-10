<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Diagnosis;

class YesNoController extends Controller
{
    public function index(): View
    {
        return view('start');
    }

    public function gender(): View
    {
        return view('gender');
    }

    public function age(Request $request): View
    {
        session(['gender' => $request->gender]); // 性別をセッションに保存
        return view('age');
    }

    public function diagnosis(Request $request): View
    {
        session(['age' => $request->age]); // 年代をセッションに保存
        return view('index'); // 診断のYes/Noページ
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function results()
    {
        // 診断結果のマッピング
        $resultMapping = [
            'a1' => '普通肌',
            'a2' => '脂性肌',
            'a3' => '乾燥肌',
            'a4' => '混合肌',
        ];

        $result = Diagnosis::latest()->first();

        if (!$result) {
            return redirect()->route('index')->with('error', '診断結果が見つかりませんでした。');
        }

        // 診断結果を配列形式に変換
        $results = explode(',', $result->result); // カンマ区切りの診断結果

        // 結果を人間が読める形式に変換
        $readableResults = array_map(function ($code) use ($resultMapping) {
            return $resultMapping[$code] ?? '診断結果が見つかりません';
        }, $results);

        // ビューにデータを渡す
        return view('results', [
            'readableResults' => $readableResults,
            'gender' => $result->gender,
            'age' => $result->age,
        ]);
    }

    public function storeResult(Request $request): RedirectResponse
    {
        // セッションから性別と年代を取得
        $gender = session('gender');
        $age = session('age');
        $result = $request->input('result'); // 診断結果を取得

        if (empty($result)) {
            $result = 'a1'; // デフォルトは「普通肌」
        }

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
