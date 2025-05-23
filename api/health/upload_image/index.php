<?php
require_once '../../app.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = basename($_FILES['image']['name']);
    $targetPath = $uploadDir . time() . "_" . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        echo json_encode([
            'status' => 'success',
            'path' => 'uploads/' . basename($targetPath)
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Upload failed']);
    }
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
