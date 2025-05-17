<?php
// 共通処理を読み込む
require_once 'app.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

$posts = $_POST;

$sql = "UPDATE health_records
        SET weight = :weight,
            heart_rate = :heart_rate,
            systolic = :systolic,
            diastolic = :diastolic,
            recorded_at = :recorded_at
        WHERE id = :id";
$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':weight' => (float) $posts['weight'],
    ':heart_rate' => (int) $posts['heart_rate'],
    ':systolic' => (int) $posts['systolic'],
    ':diastolic' => (int) $posts['diastolic'],
    ':recorded_at' => $posts['recorded_at'],
    ':id' => $posts['id'],
]);

header('Location: history.php');
exit;