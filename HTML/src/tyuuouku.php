<?php
//データベース接続
$dsn='mysql:dbname=seisaku;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


//「検索」ボタン押下時
if (isset($_POST["search"])) {

$search_town = $_POST["search_town"];

// 実行（itemsテーブルからデータ取得）
$sql_items = "SELECT * FROM tyuuouku_items0 WHERE town LIKE '%{$search_town}%'";
$rec_items = $dbh->prepare($sql_items);
$rec_items->execute();
$rec_list_items = $rec_items->fetchAll(PDO::FETCH_ASSOC);

// 実行（items2テーブルからデータ取得）
$sql_items2 = "SELECT * FROM tyuuouku_items1 WHERE town LIKE '%{$search_town}%'";
$rec_items2 = $dbh->prepare($sql_items2);
$rec_items2->execute();
$rec_list_items2 = $rec_items2->fetchAll(PDO::FETCH_ASSOC);
} else {
// 「検索」ボタン押下してないとき（itemsテーブルからデータ取得）
$sql_items = 'SELECT * FROM tyuuouku_items0 WHERE 1';
$rec_items = $dbh->prepare($sql_items);
$rec_items->execute();
$rec_list_items = $rec_items->fetchAll(PDO::FETCH_ASSOC);

// （items2テーブルからデータ取得）
$sql_items2 = 'SELECT * FROM tyuuouku_items1 WHERE 1';
$rec_items2 = $dbh->prepare($sql_items2);
$rec_items2->execute();
$rec_list_items2 = $rec_items2->fetchAll(PDO::FETCH_ASSOC);
}


//データベース切断
$dbh=null;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>

<!--検索-->
<form action="tyuuouku.php" method="POST">
<table border="1" style="border-collapse: collapse">
<tr>
<th>町検索</th>
<td><input type="text" name="search_town" value="<?php if (!empty($_POST['search_town'])) { echo $_POST['search_town']; } ?>"></td>
<td><input type="submit" name="search" value="検索"></td>
</tr>
</table>
</form>
<br />
<p>○ その災害時に利用できる施設<br>
△ 「備考」欄の注意事項を確認のうえ、緊急時のみ利用できる施設<br>
× 原則利用できない施設<br>
― その災害による避難を想定していない施設<br></p>
<h2>○屋内の緊急避難場所（土砂災害、洪水、津波のとき）、避難所</h2>
<!--検索解除-->
<?php if (isset($_POST["search"])) {?>
<a href="http://localhost/seisakujisyu_Y/HTML/src/tyuuouku.php">検索を解除</a><br />
<?php } ?>

<table border="1" style="border-collapse: collapse">
<tr>
<th>名前</th>
<th>町</th>
<th>電話番号</th>
<th>土砂災害</th>
<th>洪水</th>
<th>津波</th>
<th>避難所としての利用</th>
<th>ペット</th>
</tr>

<!--MySQLデータを表示-->
<?php foreach ($rec_list_items as $rec) { ?>
<tr>
<td><?php echo $rec['name'];?></td>
<td><?php echo $rec['town'];?></td>
<td><?php echo $rec['telephone'];?></td>
<td><?php echo $rec['dosha'];?></td>
<td><?php echo $rec['kouzui'];?></td>
<td><?php echo $rec['tunami'];?></td>
<td><?php echo $rec['Shelter'];?></td>
<td><?php echo $rec['petto'];?></td>
</tr>
<?php } ?>
</table>

<h2>○屋外の緊急避難場所（津波、大火のとき）</h2>
<table border="1" style="border-collapse: collapse">
<tr>
<th>名前</th>
<th>町</th>
<th>津波</th>
<th>火災</th>
<th>ペット</th>
</tr>

<!--MySQLデータを表示-->
<?php foreach ($rec_list_items2 as $rec) { ?>
<tr>
<td><?php echo $rec['name'];?></td>
<td><?php echo $rec['town'];?></td>
<td><?php echo $rec['tunami1'];?></td>
<td><?php echo $rec['fire'];?></td>
<td><?php echo $rec['petto1'];?></td>
</tr>
<?php } ?>
</table>
</body>
</html>