<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームから送信されたデータを受け取る
    $keyword = $_POST["keyword"]; 

    // ここに検索結果を表示するためのコードを追加します
    echo "<p>検索キーワード: $keyword</p>"; 
}
?>