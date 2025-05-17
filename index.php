<!DOCTYPE html>
<html lang="ja">

<?php include 'components/head.php' ?>

<body>
    <?php include 'components/nav.php' ?>

    <main class="container mx-auto">
        <!-- ダウンロード -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">健康記録</h1>
            <button onclick="downloadChart()" class="bg-green-600 text-xs text-white px-4 py-2 rounded">
                グラフダウンロード
            </button>
        </div>
        <!-- グラフ -->
        <section class="mb-8">
            <canvas id="weightChart" height="150" class="mb-12"></canvas>
            <canvas id="heartRateChart" height="150" class="mb-12"></canvas>
            <canvas id="bpChart" height="150"></canvas>
        </section>
    </main>

    <!-- JS -->
    <script src="js/app.js" defer></script>
</body>

</html>