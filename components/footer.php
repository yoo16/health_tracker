<footer class="bg-sky-700 text-white">
    <div class="max-w-6xl mx-auto px-6 py-10 md:px-10">

        <!-- 上段：ロゴ＋ナビ -->
        <div class="flex flex-col gap-8 md:flex-row md:items-start md:justify-between">

            <!-- ロゴ＋キャッチ -->
            <div class="space-y-3">
                <a href="./" class="inline-flex items-center gap-2">
                    KENKO LOG
                </a>
            </div>

            <!-- フッターナビ -->
            <nav class="grid grid-cols-2 gap-x-12 gap-y-2 text-sm text-sky-100 sm:flex sm:gap-10">
                <a href="./"          class="transition hover:text-white">ホーム</a>
                <a href="add.php"     class="transition hover:text-white">新規記録</a>
                <a href="history.php" class="transition hover:text-white">履歴</a>
                <a href="chart.php"   class="transition hover:text-white">グラフ</a>
                <a href="camera.php"  class="transition hover:text-white">カメラ診断</a>
            </nav>
        </div>

        <!-- 区切り線 -->
        <div class="mt-8 border-t border-sky-600 pt-6 flex flex-col gap-2 text-xs text-sky-300
                    sm:flex-row sm:items-center sm:justify-between">
            <span>&copy; <?= date('Y') ?> <?= SITE_TITLE ?>. All rights reserved.</span>
            <span>
                <a href="./" class="hover:text-white transition"><?= SITE_TITLE ?></a>
            </span>
        </div>
    </div>
</footer>
