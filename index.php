<?php
require_once 'app.php';
?>

<!DOCTYPE html>
<html lang="ja">

<?php include 'components/head.php'; ?>

<body class="flex flex-col">

    <?php include 'components/nav.php'; ?>

    <main class="flex-grow container mx-auto">
        <section class="justify-center items-center flex flex-col bg-white p-6">
            <img src="images/top.png" class="w-1/2" alt="健康管理アプリ" />
            <h2 class="text-xl font-semibold mb-4 text-green-600">あなたの毎日を、もっと健康に。</h2>
            <p class="text-green-500 mb-4 text-sm">
                体調の変化を見逃さないために、日々の健康状態を記録しましょう。
            </p>
            <div>
                <a href="history.php" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                    はじめる
                </a>
            </div>
        </section>
    </main>

    <?php include 'components/footer.php'; ?>

    <script src="js/app.js" defer></script>
</body>

</html>