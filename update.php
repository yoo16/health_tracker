<?php
// 共通処理を読み込む
require_once 'app.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

// POSTデータの取得
$posts = $_POST;

if (hasDuplicate($posts)) {
    // 重複があればエラーメッセージを表示
    $_SESSION['message'] = 'この日付の記録はすでに存在します。';
    header("Location: edit.php?id={$posts['id']}");
    exit;
} else {
    update($posts['id'], $posts);
    header('Location: history.php');
    exit;
}

function update($id, $data)
{
    // データベース接続
    $pdo = Database::getInstance();
    // SQLクエリ
    $sql = "UPDATE health_records 
            SET 
                weight = :weight, 
                heart_rate = :heart_rate, 
                systolic = :systolic, 
                diastolic = :diastolic, 
                recorded_at = :recorded_at 
            WHERE id = :id";
    // プリペアドステートメントを作成
    $stmt = $pdo->prepare($sql);
    // SQLを実行
    $stmt->execute([
        ':weight' => $data['weight'],
        ':heart_rate' => $data['heart_rate'],
        ':systolic' => $data['systolic'],
        ':diastolic' => $data['diastolic'],
        ':recorded_at' => $data['recorded_at'],
        ':id' => $id,
    ]);
}

function hasDuplicate($posts)
{
    // データベース接続
    $pdo = Database::getInstance();
    // reported_at が重複しているか確認
    $sql = "SELECT id FROM health_records WHERE recorded_at = :recorded_at";
    // プリペアドステートメントを作成
    $stmt = $pdo->prepare($sql);
    // SQLを実行
    $stmt->execute([':recorded_at' => $posts['recorded_at']]);
    // 結果を取得
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // レコードが存在するか boolean を返す
    return (bool) $row;
}