<?php
// セッションの開始
session_start();

// 初期値
$form = [
    'weight' => 50,
    'heart_rate' => 80,
    'systolic' => 120,
    'diastolic' => 80,
    'recorded_at' => date('Y-m-d'),
];

if (isset($_SESSION['form'])) {
    // セッションから値を取得
    $form = $_SESSION['form'];
}

// エラーメッセージの取得
$message = $_SESSION['message'] ?? '';
// セッションからエラーメッセージを削除
unset($_SESSION['form'], $_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="ja">

<?php include 'components/head.php' ?>

<body>
    <?php include 'components/nav.php' ?>

    <main class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">健康記録-追加</h1>
        <!-- メッセージ -->
        <?php if ($message): ?>
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form action="insert.php" method="post" class="space-y-4">
            <div>
                <label class=" block mb-1 font-semibold">記録日</label>
                <input type="date" name="recorded_at" required
                    class="w-full border p-2 rounded"
                    value="<?= $form['recorded_at'] ?>">
            </div>
            <div>
                <label class="block mb-1 font-semibold">体重（kg）</label>
                <input type="number" name="weight" step="0.1" required
                    class="w-full border p-2 rounded"
                    value="<?= $form['weight'] ?>">
            </div>
            <div>
                <label class="block mb-1 font-semibold">心拍数</label>
                <input type="number" name="heart_rate" step="1" required
                    class="w-full border p-2 rounded"
                    value="<?= $form['heart_rate'] ?>">
            </div>
            <div>
                <label class="block mb-1 font-semibold">血圧（上）</label>
                <input type="number" name="systolic" step="1" required
                    class="w-full border p-2 rounded"
                    value="<?= $form['systolic'] ?>">
            </div>
            <div>
                <label class="block mb-1 font-semibold">血圧（下）</label>
                <input type="number" name="diastolic" step="1" required
                    class="w-full border p-2 rounded"
                    value="<?= $form['diastolic'] ?>">
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    登録
                </button>
                <a href="history.php" class="block text-gray-600 px-4 py-2 hover:text-gray-800 border rounded">戻る</a>
            </div>
        </form>
        </div>
</body>

</html>