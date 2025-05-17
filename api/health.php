<?php
require_once '../db.php';

header('Content-Type: application/json');

// health_records から最新30件取得
$sql = "SELECT * FROM health_records ORDER BY recorded_at ASC LIMIT 30";
$stmt = $pdo->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);