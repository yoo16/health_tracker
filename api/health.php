<?php
require_once '../app.php';

header('Content-Type: application/json');

// データベース接続
$pdo = Database::getInstance();
// health_records から最新30件取得
$sql = "SELECT * FROM health_records ORDER BY recorded_at ASC LIMIT 30";
// プリペアドステートメントを作成
$stmt = $pdo->prepare($sql);
// SQLを実行
$stmt->execute();
// 結果を取得
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// JSON形式で出力
echo json_encode($data);