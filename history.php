<?php
require_once 'app.php';

$sql = "SELECT * FROM health_records ORDER BY recorded_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">

<?php include 'components/head.php' ?>

<body>
    <?php include 'components/nav.php' ?>

    <main class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-green-600">履歴</h1>
            <div class="flex space-x-4">
                <a href="add.php" class="bg-green-600 text-xs text-white px-4 py-2 rounded">
                    新規記録
                </a>
                <!-- ダウンロード -->
                <a href="api/csv_download.php" class="bg-green-600 text-xs text-white px-4 py-2 rounded">
                    CSVダウンロード
                </a>
            </div>
        </div>
        <table class="w-full table-auto border-collapse text-xs">
            <thead class="text-left text-green-700">
                <tr class="border-b border-gray-100">
                    <th class="p-2 font-normal"></th>
                    <th class="p-2 font-normal">日付</th>
                    <th class="p-2 font-normal">体重</th>
                    <th class="p-2 font-normal">心拍数</th>
                    <th class="p-2 font-normal">血圧（上）</th>
                    <th class="p-2 font-normal">血圧（下）</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $row): ?>
                    <tr class="border-b border-gray-100 text-gray-700">
                        <td class="p-2">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="text-sky-500 text-xs">編集</a>
                        </td>
                        <td class="p-2"><?= $row['recorded_at'] ?></td>
                        <td class="p-2"><?= $row['weight'] ?> kg</td>
                        <td class="p-2"><?= $row['heart_rate'] ?> bpm</td>
                        <td class="p-2"><?= $row['systolic'] ?> mmHg</td>
                        <td class="p-2"><?= $row['diastolic'] ?> mmHg</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <?php include 'components/footer.php'; ?>
    <!-- JS -->
    <script src="js/app.js" defer></script>
</body>

</html>