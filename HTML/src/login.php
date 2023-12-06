<?php
$userId   = $_POST['userId'];
$password = $_POST['password'];

require_once __DIR__ . '/classes/user.php';
$user = new User();
$result = $user->authUser($userId, $password);

if (empty($result['userId'])) {
    $login_error = 'ユーザーID、パスワードを確認してください。';
}

require_once __DIR__ . '/util.php';
?>

 <!DOCTYPE html>
 <html lang="ja">

 <head>
    <meta charset="UTF-8">
    <title>ようこそ</title>
    <link rel="stylesheet" href="css/login.css">
 </head>

 <body>
    <div id="main">
        <?php
        if (empty($login_error)) {
            echo "<h2>ようこそ！</h2>";
            echo "<hr><br>";
            echo "こんにちは," . h($result['userName']) . "さん！";
            echo "<p><a href='seisaku6.html'>ログインページへ</a></p>";
        }   else {
            echo "<h2>ユーザーID、パスワードが違います。</h2>";
            echo "<hr><br>";
            echo "ユーザーID、パスワードを確認してください。";
            echo "<p><a href='seisaku6.html'>ログインページへ</a></p>";
        }
        ?>
        <hr>
    </div>
 </body>
 
 </html>