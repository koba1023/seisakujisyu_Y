<?php
$userId = $_POST['userId'];
$password = $_POST['password'];
$userName = $_POST['userName'];

require_once __DIR__ . '/classes/user.php';
$user = new User();
$result = $user->signUp($userId,$password, $userName);


require_once __DIR__ . '/util.php';
?>

<!DOCTYPE html>
<html lang="ja">
    
<head>
    <meta charset="UTF-8">
    <title>新規登録ページ</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div id="main">
        <?php

        if ($result === '') {
            echo "<h2>ユーザー登録が完了しました</h2>";
            echo "<hr><br>";
            echo "<table id='regiTable'>";
            echo "<tr><th>ユーザーID</th><td>" . h($userId) . "</td></tr>";
            echo "<tr><th>パスワード</th><td>" . h($password) . "</td></tr>";
            echo "<tr><th>お名前</th><td>" .h($userName) . "</td></tr>";
            echo "</table>";
            echo "<p><a href='seisaku6.html'>ログインページへ</a></p>";
        }   else   {
            echo "<h2>登録に失敗しました</h2>";
            echo "<hr><br>";
            echo $result;
            echo "<p><a href='seisaku7.html'>新規ユーザー登録へ戻る</a></p>";
        }
        ?>
        <hr>
    </div>
</body>

</html>