<?php
// 共通処理を読み込む
require_once 'app.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM health_records WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header("Location: index.php");
exit;