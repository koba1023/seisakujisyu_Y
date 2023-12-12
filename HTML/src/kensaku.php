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

//実行
$sql="SELECT * FROM items WHERE town LIKE '%{$search_town}%'";
$rec = $dbh->prepare($sql);
$rec->execute();
$rec_list = $rec->fetchAll(PDO::FETCH_ASSOC);

}else{

//「検索」ボタン押下してないとき
$sql='SELECT * FROM items WHERE 1';
$rec = $dbh->prepare($sql);
$rec->execute();
$rec_list = $rec->fetchAll(PDO::FETCH_ASSOC);
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
<form action="kensaku.php" method="POST">
<table border="1" style="border-collapse: collapse">
<tr>
<th>町検索</th>
<td><input type="text" name="search_town" value="<?php if (!empty($_POST['search_town'])) { echo $_POST['search_town']; } ?>"></td>
<td><input type="submit" name="search" value="検索"></td>
</tr>
</table>
</form>
<br />

<!--検索解除-->
<?php if (isset($_POST["search"])) {?>
<a href="http://localhost/seisakujisyu_Y/HTML/src/kensaku.php">検索を解除</a><br />
<?php } ?>

<table border="1" style="border-collapse: collapse">
<tr>
<th>名前</th>
<th>町</th>
<th>土砂災害</th>
<th>洪水</th>
<th>津波</th>
<th>ペット</th>
</tr>

<!--MySQLデータを表示-->
<?php foreach ($rec_list as $rec) { ?>
<tr>
<td><?php echo $rec['name'];?></td>
<td><?php echo $rec['town'];?></td>
<td><?php echo $rec['dosha'];?></td>
<td><?php echo $rec['kouzui'];?></td>
<td><?php echo $rec['tunami'];?></td>
<td><?php echo $rec['petto'];?></td>
</tr>
<?php } ?>
</table>

</body>
</html>