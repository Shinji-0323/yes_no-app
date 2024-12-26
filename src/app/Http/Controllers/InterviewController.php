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
        session([
            'age' => $validated['age'],
            'current_category' => 'beauty',
            'yes_counts' => [
                'beauty' => 0,
                'period' => 0,
                'menopause' => 0,
            ],
        ]);

        return $this->getQuestionView('beauty');
    }

    public function nextCategory()
    {
        $currentCategory = session('current_category');
        $categories = ['beauty', 'period', 'menopause'];

        // 次のカテゴリを設定
        $nextCategory = $categories[array_search($currentCategory, $categories) + 1] ?? null;

        if ($nextCategory) {
            session(['current_category' => $nextCategory]);
            return $this->getQuestionView($nextCategory);
        }

        // 全てのカテゴリが終わった場合、データベースに保存
        $yesCounts = session('yes_counts');
        Interview::create([
            'name' => session('name'),
            'age' => session('age'),
            'beauty_count' => $yesCounts['beauty'] ?? 0,
            'period_count' => $yesCounts['period'] ?? 0,
            'menopause_count' => $yesCounts['menopause'] ?? 0,
            'total_count' => array_sum($yesCounts),
        ]);

        // 結果画面を表示
        return redirect()->route('interview.results');
    }

    private function getQuestionView(string $category): View
    {
        $questions = [
            'beauty' => [
                'おまたを鏡で見たことがない',
                'VIO脱毛をしていない',
                '保湿を行っていない',
                '黒ずみが気になる',
                'ニオイやかゆみが気になる',
                'おりものシートを常時使用している',
                '食事（特に朝食）を抜くことが多い',
                '便秘だ（3日以上出ないことがよくある）',
                '浮腫みやすい',
                '入浴は週に3回以下である',
            ],
            'period' => [
                '生理が予定から7～10日以上レることがある',
                '生理が2日未満で終わる。または8日以上かかる',
                '排血に塊が混じっている',
                '生理痛がある',
                'PMSがある',
                '紙ナプキンを使用している',
                '就寝中に排血がある（または夜用ナプキンが手放せない）',
                'お腹まわりが冷たい',
            ],
            'menopause' => [
                '顔がほてる・顔だけ汗をかく',
                '息切れや動機がすることが増えた',
                '頭痛やめまいがある',
                '手足や関節の痛みがある',
                '寝つくまでに時間がかかる・または眠りが浅い',
                '胃もたれや消化不良を起こしやすくなった',
                '疲れやすくなった',
                '気分の浮き沈みがある',
                'とりとめもない事でイライラするようになった',
                '何かをするにもやる気がでない・億劫・憂鬱だ',
            ],
        ];

        return view('interview.index', [
            'category' => ucfirst($category),
            'questions' => $questions[$category],
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function storeResult(Request $request): RedirectResponse
    {
        $category = strtolower($request->input('category')); // カテゴリ名を小文字に統一
        $yesCount = (int) $request->input('yesCount'); // Yesの数を取得

        // セッションにYes数を保存
        $yesCounts = session('yes_counts', []);
        $yesCounts[$category] = $yesCount;
        session(['yes_counts' => $yesCounts]);

        return response()->json(['success' => true]);
    }

    public function results(): View
    {
        $yesCounts = session('yes_counts', [
            'beauty' => 0,
            'period' => 0,
            'menopause' => 0,
        ]);

        return view('interview.results', [
            'beautyCount' => $yesCounts['beauty'] ?? 0,
            'periodCount' => $yesCounts['period'] ?? 0,
            'menopauseCount' => $yesCounts['menopause'] ?? 0,
            'totalCount' => array_sum($yesCounts),
        ]);
    }
}