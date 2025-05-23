<?php
// 共通処理を読み込む
require_once 'app.php';
?>

<!DOCTYPE html>
<html lang="ja">

<?php include 'components/head.php' ?>

<body>
    <?php include 'components/nav.php' ?>

    <main class="container mx-auto">
        <?php include 'components/Camera.php' ?>
    </main>

    <?php include 'components/footer.php'; ?>
</body>

</html>