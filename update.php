<?php
require_once 'db.php';

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