<?php

namespace App\Http\Controllers;

use App\Http\Requests\NameRequest;
use App\Http\Requests\AgeRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Interview;

class InterviewController extends Controller
{
    public function index(): View
    {
        return view('interview/start');
    }

    public function name(): View
    {
        return view('interview/name');
    }

    public function age(NameRequest $request): View
    {
        $validated = $request->validated(); // バリデーション済みデータを取得
        session(['name' => $validated['name']]); // 名前をセッションに保存
        return view('interview/age');
    }

    public function interview(AgeRequest $request): View
    {
        $validated = $request->validated(); // バリデーション済みデータを取得
        session(['age' => $validated['age']]); // 年齢をセッションに保存
        return view('interview/index');
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function results()
    {
        $yesCount = session('yesCount', 0); // セッションからYesの数を取得

        return view('interview/results', [
            'yesCount' => $yesCount,
        ]);
    }

    public function storeResult(Request $request): RedirectResponse
    {
        // セッションから性別と年代を取得
        $name = session('name');
        $age = session('age');
        $yesCount = $request->input('result');  // Yes回答数を取得

        // データベースに保存
        Interview::create([
            'name' => $name,
            'age' => $age,
            'result' => $yesCount, // Yesの数を保存
        ]);

        // 結果ページを表示（またはサンクスページ）
        return redirect()->route('interview.results')->with('yesCount', $yesCount);
    }
}
