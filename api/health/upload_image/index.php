<?php
require_once '../../../app.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['image'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

$uploadDir = '../images/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// アップロード画像ファイル名
$filename = basename($_FILES['image']['name']);
// アップロード画像ファイルのパス
$targetPath = $uploadDir . time() . "_" . $filename;

// アップロード画像の移動
if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
    $results = [
        'status' => 'success',
        'path' => 'uploads/' . basename($targetPath)
    ];
    echo json_encode($results);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Upload failed']);
}
