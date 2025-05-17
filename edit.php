<?php
require_once 'db.php';

// GETリクエストからIDを取得
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
// health_recordsテーブルから該当レコードを取得
$sql = "SELECT * FROM health_records WHERE id = :id";
$stmt = $pdo->prepare($sql);
// SQLを実行
$stmt->execute([':id' => $id]);
// 結果を取得
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    header('Location: ./');
}
?>

<!DOCTYPE html>
<html lang="ja">

<?php include 'components/head.php' ?>

<body>
    <?php include 'components/nav.php' ?>

    <main class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">健康記録-編集</h1>
        <form action="update.php" method="post" class="space-y-4">
            <input type="hidden" name="id" value="<?= $record['id'] ?>">
            <div>
                <label class="block mb-1 font-semibold">体重（kg）</label>
                <input type="number" name="weight" step="0.1" required
                    value="<?= $record['weight'] ?>"
                    class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1 font-semibold">心拍数（bpm）</label>
                <input type="number" name="heart_rate" required
                    value="<?= $record['heart_rate'] ?>"
                    class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1 font-semibold">血圧（上）</label>
                <input type="number" name="systolic" required
                    class="w-full border p-2 rounded"
                    value="<?= $record['systolic'] ?>">
            </div>
            <div>
                <label class="block mb-1 font-semibold">血圧（下）</label>
                <input type="number" name="diastolic" required
                    class="w-full border p-2 rounded"
                    value="<?= $record['diastolic'] ?>">
            </div>
            <div>
                <label class="block mb-1 font-semibold">記録日</label>
                <input type="date" name="recorded_at" required
                    value="<?= $record['recorded_at'] ?>"
                    class="w-full border p-2 rounded">
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    更新
                </button>
                <a href="./" class="block text-gray-600 px-4 py-2 hover:text-gray-800 border rounded">戻る</a>
            </div>
        </form>

        <form action="delete.php" method="post" onsubmit="return confirm('この記録を削除してもよろしいですか？');" class="mt-6 text-right">
            <input type="hidden" name="id" value="<?= $record['id'] ?>">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                削除
            </button>
        </form>
    </div>
</body>

</html>