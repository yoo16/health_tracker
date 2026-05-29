<?php
$basePath = BASE_URL;
?>

<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm shadow-sm border-b border-sky-100">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- ロゴ -->
        <a href="<?= $basePath ?>" class="inline-flex items-center gap-2 group">
            <img src="<?= $basePath ?>images/logo.png" class="h-10 w-auto" alt="Kenko Log">
        </a>

        <!-- ナビゲーション（デスクトップ） -->
        <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
            <li>
                <a href="<?= $basePath ?>" class="relative py-1 transition hover:text-sky-600
                    after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0
                    after:bg-sky-500 after:transition-all hover:after:w-full">
                    ホーム
                </a>
            </li>
            <li>
                <a href="<?= $basePath ?>health/" class="relative py-1 transition hover:text-sky-600
                    after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0
                    after:bg-sky-500 after:transition-all hover:after:w-full">
                    健康履歴
                </a>
            </li>
            <li>
                <a href="<?= $basePath ?>dashboard/" class="relative py-1 transition hover:text-sky-600
                    after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0
                    after:bg-sky-500 after:transition-all hover:after:w-full">
                    ダッシュボード
                </a>
            </li>
            <li>
                <a href="<?= $basePath ?>health/" class="relative py-1 transition hover:text-sky-600
                    after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0
                    after:bg-sky-500 after:transition-all hover:after:w-full">
                    履歴
                </a>
            </li>
            <li>
                <a href="<?= $basePath ?>chart.php" class="relative py-1 transition hover:text-sky-600
                    after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0
                    after:bg-sky-500 after:transition-all hover:after:w-full">
                    グラフ
                </a>
            </li>
            <li>
                <a href="<?= $basePath ?>camera.php" class="relative py-1 transition hover:text-sky-600
                    after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0
                    after:bg-sky-500 after:transition-all hover:after:w-full">
                    カメラ診断
                </a>
            </li>
        </ul>

        <!-- CTAボタン -->
        <div class="hidden md:flex items-center gap-3">
            <a href="<?= $basePath ?>login/"
                class="rounded-md border border-sky-300 px-5 py-2 text-sm font-semibold text-sky-700
                      transition hover:bg-sky-50">
                ログイン
            </a>
            <a href="<?= $basePath ?>register/"
                class="rounded-md kenko-gradient px-5 py-2 text-sm font-semibold text-white shadow-sm
                      transition hover:opacity-90">
                無料で始める
            </a>
        </div>

        <!-- ハンバーガー（モバイル） -->
        <button id="nav-toggle" class="md:hidden p-2 rounded-md text-slate-600 hover:bg-sky-50"
            aria-label="メニューを開く">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- モバイルメニュー -->
    <div id="nav-mobile" class="hidden md:hidden border-t border-sky-100 bg-white px-6 py-4">
        <ul class="flex flex-col gap-4 text-sm font-medium text-slate-600">
            <li><a href="<?= $basePath ?>" class="block py-1 hover:text-sky-600">ホーム</a></li>
            <li><a href="<?= $basePath ?>health/add.php" class="block py-1 hover:text-sky-600">新規記録</a></li>
            <li><a href="<?= $basePath ?>dashboard/" class="block py-1 hover:text-sky-600">ダッシュボード</a></li>
            <li><a href="<?= $basePath ?>health/" class="block py-1 hover:text-sky-600">履歴</a></li>
            <li><a href="<?= $basePath ?>chart.php" class="block py-1 hover:text-sky-600">グラフ</a></li>
            <li><a href="<?= $basePath ?>camera.php" class="block py-1 hover:text-sky-600">カメラ診断</a></li>
        </ul>
        <div class="mt-4 flex flex-col gap-2">
            <a href="<?= $basePath ?>login/"
                class="rounded-md border border-sky-300 px-5 py-2 text-center text-sm font-semibold text-sky-700">
                ログイン
            </a>
            <a href="<?= $basePath ?>register/"
                class="rounded-md kenko-gradient px-5 py-2 text-center text-sm font-semibold text-white">
                無料で始める
            </a>
        </div>
    </div>
</nav>

<script>
    document.getElementById('nav-toggle').addEventListener('click', () => {
        document.getElementById('nav-mobile').classList.toggle('hidden');
    });
</script>
