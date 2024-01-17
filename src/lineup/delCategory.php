<?php session_start(); ?>
<?php require '../initial/db-connect.php' ?>
<?php
    $id = $_POST['id'] ?? 0;
    $sql = $db -> query("SELECT * FROM Categories");
    $res = $sql -> fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - カテゴリ削除</title>
        <link rel="stylesheet" href="../css/control.css">
    </head>
    <body>
        <div class="centering">
            <h1>カテゴリ選択・削除確認</h1>
            <form action="delCategory_process.php" method="post">
                <input type="hidden" name="id" value="<?=$id?>">
                <p class="text">カテゴリを選んでください。</p>
                <select class="text" name="ctgr" required>
                    <?php
                        $i = 0;
                        foreach($res as $row){
                            echo '<option value="', $row['category_name'], '">', $row['category_name'], '</option>';
                        }
                    ?>
                </select>
                <p class="warning">
                    <?php
                        $err = $_GET['err'] ?? null;
                        switch ($err) {
                            case '1':
                                echo 'エラー: すでに削除されています。<br><br>';
                                break;
                        }
                    ?>
                    以上のカテゴリを削除します。<br>
                    この操作は取り消すことができません。<br>
                    このカテゴリに設定されていた財宝は<br>
                    自動的に「無分類」に設定されます。<br>
                    本当によろしいですか？<br>
                </p>
                <button class="go" type="button" onclick="history.back();">戻る</button>&emsp;
                <button class="go">削除する</button>
            </form>
        </div>

        <script src="js/script.js"></script>
    </body>
</html>