<?php
require_once 'db.php';
$sql = "SELECT * FROM health_records ORDER BY recorded_at DESC";
$records = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">

<?php include 'components/head.php' ?>

<body>
    <?php include 'components/nav.php' ?>

    <main class="container mx-auto">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold mb-6">健康記録-履歴</h1>
            <a href="api/csv_download.php" class="bg-green-600 text-xs text-white px-4 py-2 rounded hover:bg-green-700">
                CSVダウンロード
            </a>
        </div>
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-2 border"></th>
                    <th class="p-2 border">日付</th>
                    <th class="p-2 border">体重</th>
                    <th class="p-2 border">血圧（上）</th>
                    <th class="p-2 border">血圧（下）</th>
                    <th class="p-2 border">心拍数</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $row): ?>
                    <tr class="border-t">
                        <td class="p-2">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="">編集</a>
                        </td>
                        <td class="p-2"><?= $row['recorded_at'] ?></td>
                        <td class="p-2"><?= $row['weight'] ?> kg</td>
                        <td class="p-2"><?= $row['systolic'] ?> mmHg</td>
                        <td class="p-2"><?= $row['diastolic'] ?> mmHg</td>
                        <td class="p-2"><?= $row['heart_rate'] ?> bpm</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <!-- JS -->
    <script src="js/app.js" defer></script>
</body>

</html>