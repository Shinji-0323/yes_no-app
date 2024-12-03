<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function results()
    {
        $results = Diagnosis::all();
        return view('admin.results', compact('results'));
    }

    public function exportCsv()
    {
        $results = Diagnosis::all();
        $csvData = [];
        foreach ($results as $result) {
            $csvData[] = [$result->id, $result->gender, $result->age, $result->result];
        }

        $fileName = 'diagnosis_results.csv';
        $headers = ['Content-Type' => 'text/csv'];

        $callback = function () use ($csvData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', '性別', '年代', '結果']);
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers)->header('Content-Disposition', "attachment; filename={$fileName}");
    }
}
