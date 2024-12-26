<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Diagnosis;
use App\Models\Interview;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function results(): \Illuminate\View\View
    {
        $diagnoses = Diagnosis::all();

        // 性別と結果のマッピング
        $genderMapping = [
            'male' => '男性',
            'female' => '女性',
        ];

        $resultMapping = [
            'a1' => '普通肌',
            'a2' => '脂性肌',
            'a3' => '乾燥肌',
            'a4' => '混合肌',
        ];

        // データ加工
        $processedDiagnoses = $diagnoses->map(function ($diagnosis) use ($genderMapping, $resultMapping) {
            $results = explode(',', $diagnosis->result);
            $readableResults = array_map(function ($result) use ($resultMapping) {
                return $resultMapping[$result] ?? $result;
            }, $results);

            return [
                'id' => $diagnosis->id,
                'gender' => $genderMapping[$diagnosis->gender] ?? $diagnosis->gender,
                'age' => $diagnosis->age . '代',
                'result' => implode('・', $readableResults),
            ];
        });

        return view('admin.results', ['diagnoses' => $processedDiagnoses]);
    }

    public function export(): StreamedResponse
    {
        $results = Diagnosis::all();
        // 性別と結果のマッピング
        $genderMapping = [
            'male' => '男性',
            'female' => '女性',
        ];

        $resultMapping = [
            'a1' => '普通肌',
            'a2' => '脂性肌',
            'a3' => '乾燥肌',
            'a4' => '混合肌',
        ];

        // データを整形してCSV用に準備
        $csvData = [];
        foreach ($results as $result) {
            $resultLabels = array_map(function ($item) use ($resultMapping) {
                return $resultMapping[$item] ?? $item;
            }, explode(',', $result->result));

            // 結果を文字列に変換
            $formattedResult = implode('・', $resultLabels);

            $csvData[] = [
                $result->id,
                $genderMapping[$result->gender] ?? $result->gender,
                $result->age . '代',
                $formattedResult,
            ];
        }

        $fileName = 'diagnosis_results.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () use ($csvData) {
            $file = fopen('php://output', 'w');
            if ($file === false) {
                throw new \RuntimeException('Failed to open output stream.');
            }

            fputcsv($file, ['ID', '性別', '年代', '結果']); // CSVのヘッダー
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function interview_results(): \Illuminate\View\View
    {
        $interviews = Interview::all();

        return view('admin.interview_results', ['interviews' => $interviews]);
    }

    public function interview_export(): StreamedResponse
    {
        $interviews = Interview::all(); // すべてのインタビュー結果を取得

        $fileName = 'interview_results.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () use ($interviews) {
            $file = fopen('php://output', 'w');
            if ($file === false) {
                throw new \RuntimeException('Failed to open output stream.');
            }

            // CSVのヘッダー
            fputcsv($file, ['ID', '名前', '年齢', '美容', '生理', '更年期', '合計']);

            foreach ($interviews as $interview) {
                fputcsv($file, [
                    $interview->id,
                    $interview->name,
                    $interview->age,
                    $interview->beauty_count,
                    $interview->period_count,
                    $interview->menopause_count,
                    $interview->total_count,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
