<?php
require_once '../app.php';

// ヘッダー：ダウンロード用にCSV形式を指定
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=health_records_latest.csv');

// 出力バッファを使って直接出力
$output = fopen('php://output', 'w');

// CSVのヘッダー行
fputcsv($output, ['recorded_at', 'weight', 'heart_rate', 'systolic', 'diastolic']);

// 最新30件のデータ取得（recorded_atの降順）
$sql = "SELECT recorded_at, weight, heart_rate, systolic, diastolic 
        FROM health_records 
        ORDER BY recorded_at DESC 
        LIMIT 30";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 各行をCSVとして出力
foreach ($rows as $row) {
    fputcsv($output, [
        $row['recorded_at'],
        $row['weight'],
        $row['heart_rate'],
        $row['systolic'],
        $row['diastolic']
    ]);
}

fclose($output);
exit;