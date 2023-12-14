<?php
// データベース接続情報
$host = 'localhost';
$username = 'bousai';
$password = 'denshi';
$database = 'bousai';

// データ受け取り
$usernameInput = $_POST['username'];
$locationInput = $_POST['location'];
$messageInput = $_POST['message'];

// クッキーにデータを保存
setcookie('saved_username', $usernameInput, time() + (86400 * 30), "/");  // 86400秒 = 1日
setcookie('saved_location', $locationInput, time() + (86400 * 30), "/");
setcookie('saved_message', $messageInput, time() + (86400 * 30), "/");

try {
    // データベースに接続
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "データベースに接続しました。";
} catch (PDOException $e) {
    die("接続エラー: " . $e->getMessage());
}

try {
    // サンプルのクエリ（your_tableとcolumn_nameは実際のものに変更してください）
    $query = "SELECT * FROM messages";
    $stmt = $pdo->query($query);

    // クエリの結果を処理
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['message'] . '<br>';
    }
} catch (PDOException $e) {
    die("クエリエラー: " . $e->getMessage());
} finally {
    // 接続を閉じる
    $pdo = null;
}
?>

