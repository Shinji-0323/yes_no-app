<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Diagnosis;

class AdminController extends Controller
{
    public function results()
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
            return [
                'id' => $diagnosis->id,
                'gender' => $genderMapping[$diagnosis->gender] ?? $diagnosis->gender,
                'age' => $diagnosis->age . '代',
                'result' => $resultMapping[$diagnosis->result] ?? $diagnosis->result,
            ];
        });

        return view('admin.results', ['diagnoses' => $processedDiagnoses]);
    }

    public function export()
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
            $csvData[] = [
                $result->id,
                $genderMapping[$result->gender] ?? $result->gender,
                $result->age . '代',
                $resultMapping[$result->result] ?? $result->result,
            ];
        }

        $fileName = 'diagnosis_results.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () use ($csvData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', '性別', '年代', '結果']); // CSVのヘッダー
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
