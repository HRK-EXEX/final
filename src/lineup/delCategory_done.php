<?php require '../initial/login-check.php' ?>
<?php require '../initial/db-connect.php' ?>
<?php $ctgr = $_POST['ctgr'] ?? null; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - カテゴリ削除完了</title>
        <link rel="stylesheet" href="../css/control.css">
    </head>
    <body onload="previewRank()">
        <div class="centering">
            <h1>カテゴリ選択・削除完了</h1>
            <form action="index.php">
                <p class="done">
                    カテゴリ情報が正常に削除されました。<br>
                </p>
                <button class="go">戻る</button>
            </form>
        </div>

        <script src="js/script.js"></script>
    </body>
</html>