<?php
// 共通処理を読み込む
require_once 'app.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

// POSTデータの取得
$posts = $_POST;

// 重複チェック
$sql = "SELECT id FROM health_records WHERE recorded_at = :recorded_at";
$stmt = $pdo->prepare($sql);
$stmt->execute([':recorded_at' => $posts['recorded_at']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $_SESSION['message'] = 'この日付の記録はすでに存在します。';
    $_SESSION['form'] = $_POST; // 入力値を保持
    header('Location: add.php');
    exit;
}

// 登録
$sql = "INSERT INTO health_records 
        (weight, heart_rate, systolic, diastolic, recorded_at) 
        VALUES (:weight, :heart_rate, :systollic, :diastolic, :recorded_at)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':weight' => $posts['weight'],
    ':heart_rate' => $posts['heart_rate'],
    ':systollic' => $posts['systolic'],
    ':diastolic' => $posts['diastolic'],
    ':recorded_at' => $posts['recorded_at'],
]);

$_SESSION['success'] = '記録を追加しました。';
header('Location: history.php');
exit;