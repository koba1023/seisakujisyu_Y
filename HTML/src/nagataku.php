<?php
// データベース接続
$dsn = 'mysql:dbname=seisaku;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql_list = "SELECT list FROM nagataku_kensaku";
$rec_list = $dbh->prepare($sql_list);
$rec_list->execute();
$list_items = $rec_list->fetchAll(PDO::FETCH_ASSOC);

// 重複の除去とソート
$list_items = array_unique($list_items, SORT_REGULAR);
sort($list_items);

// 検索条件
$search_town = isset($_POST["search_town"]) ? $_POST["search_town"] : '';
$dosha = isset($_POST['dosha']) ? $_POST['dosha'] : '';
$kouzui = isset($_POST['kouzui']) ? $_POST['kouzui'] : '';
$tunami = isset($_POST['tunami']) ? $_POST['tunami'] : '';
$Shelter = isset($_POST['Shelter']) ? $_POST['Shelter'] : '';
$petto = isset($_POST['petto']) ? $_POST['petto'] : '';
$fire = isset($_POST['fire']) ? $_POST['fire'] : '';
$tunami1 = isset($_POST['tunami1']) ? $_POST['tunami1'] : '';
$petto1 = isset($_POST['petto1']) ? $_POST['petto1'] : '';
$list = isset($_POST['list']) ? $_POST['list'] : '';

// 検索クエリの条件を構築
$searchConditions = [];
$params = [];

if (!empty($search_town)) {
    $searchConditions[] = "town LIKE :search_town";
    $params[':search_town'] = "%{$search_town}%";
}

$filterConditions = [];
if ($dosha !== '') {
    $filterConditions[] = "dosha = :dosha";
    $params[':dosha'] = $dosha;
}
if ($kouzui !== '') {
    $filterConditions[] = "kouzui = :kouzui";
    $params[':kouzui'] = $kouzui;
}
if ($tunami !== '') {
    $filterConditions[] = "tunami = :tunami";
    $params[':tunami'] = $tunami;
}
if ($Shelter !== '') {
    $filterConditions[] = "Shelter = :Shelter";
    $params[':Shelter'] = $Shelter;
}
if ($petto !== '') {
    $filterConditions[] = "petto = :petto";
    $params[':petto'] = $petto;
}

// WHERE句を組み立てる
$whereClause = '';
if (!empty($searchConditions) || !empty($filterConditions)) {
    $whereClause = 'WHERE ' . implode(' AND ', array_merge($searchConditions, $filterConditions));
}

// 実行（itemsテーブルからデータ取得）
$sql_items = "SELECT * FROM nagataku_items0 $whereClause";
$rec_items = $dbh->prepare($sql_items);
$rec_items->execute($params);
$rec_list_items = $rec_items->fetchAll(PDO::FETCH_ASSOC);


// 検索クエリの条件を構築
$searchConditions1 = [];
$params1 = [];

if (!empty($search_town)) {
    $searchConditions1[] = "town LIKE :search_town";
    $params1[':search_town'] = "%{$search_town}%";
}

$filterConditions1 = [];
if ($tunami1 !== '') {
    $filterConditions1[] = "tunami1 = :tunami1";
    $params1[':tunami1'] = $tunami1;
}
if ($fire !== '') {
    $filterConditions1[] = "fire = :fire";
    $params1[':fire'] = $fire;
}
if ($petto1 !== '') {
    $filterConditions1[] = "petto1 = :petto1";
    $params1[':petto1'] = $petto1;
}

// WHERE句を組み立てる
$whereClause1 = '';
if (!empty($searchConditions1) || !empty($filterConditions1)) {
    $whereClause1 = 'WHERE ' . implode(' AND ', array_merge($searchConditions1, $filterConditions1));
}

// 実行（itemsテーブルからデータ取得）
$sql_items1 = "SELECT * FROM nagataku_items1 $whereClause1";
$rec_items1 = $dbh->prepare($sql_items1);
$rec_items1->execute($params1);
$rec_list_items1 = $rec_items1->fetchAll(PDO::FETCH_ASSOC);


// データベース切断
$dbh = null;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<!-- 検索 -->
<form action="nagataku.php" method="POST">
    <table border="1" style="border-collapse: collapse">
        <tr>
            <th>町検索</th>
            <td>
                <!-- $list データを使用してプルダウンリストを作成 -->
                <select name="search_town">
                    <option value="">町を選択してください</option>
                    <?php foreach ($list_items as $item) : ?>
                        <option value="<?php echo $item['list']; ?>" <?php if (!empty($_POST['search_town']) && $_POST['search_town'] == $item['list']) echo 'selected'; ?>>
                            <?php echo $item['list']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><input type="submit" name="search" value="検索"></td>
        </tr>
    </table>
</form>
<br />
<!--検索解除-->
<?php if (isset($_POST["search"])) {?>
<a href="http://localhost/seisakujisyu_Y/HTML/src/nagataku.php">検索を解除</a><br />
<?php } ?>
<p>○ その災害時に利用できる施設<br>
× 原則利用できない施設<br>
― その災害による避難を想定していない施設<br></p>
<h2>○屋内の緊急避難場所（土砂災害、洪水、津波のとき）、避難所</h2>

<!-- ラジオボタンのフォーム -->
<form action="nagataku.php" method="POST">
    <tr>
        <td>
            <label>土砂災害</label>
            <label><input type="radio" name="dosha" value="○" <?php if (isset($dosha) && $dosha === '○') echo 'checked'; ?>> 〇</label>
            <label><input type="radio" name="dosha" value="×" <?php if (isset($dosha) && $dosha === '×') echo 'checked'; ?>> ×</label>
            <label><input type="radio" name="dosha" value="-" <?php if (isset($dosha) && $dosha === '-') echo 'checked'; ?>> -</label>
        </td>
        <!-- 各ラジオボタンに対応する条件判定 -->
        <td>
            <br>
            <label>洪水</label>
            <label><input type="radio" name="kouzui" value="○" <?php if (isset($kouzui) && $kouzui === '○') echo 'checked'; ?>> 〇</label>
            <label><input type="radio" name="kouzui" value="×" <?php if (isset($kouzui) && $kouzui === '×') echo 'checked'; ?>> ×</label>
            <label><input type="radio" name="kouzui" value="-" <?php if (isset($kouzui) && $kouzui === '-') echo 'checked'; ?>> -</label>
        </td>
        <!-- 各ラジオボタンに対応する条件判定 -->
        <td>
            <br>
            <label>津波</label>
            <label><input type="radio" name="tunami" value="○" <?php if (isset($tunami) && $tunami === '○') echo 'checked'; ?>> 〇</label>
            <label><input type="radio" name="tunami" value="×" <?php if (isset($tunami) && $tunami === '×') echo 'checked'; ?>> ×</label>
            <label><input type="radio" name="tunami" value="-" <?php if (isset($tunami) && $tunami === '-') echo 'checked'; ?>> -</label>
        </td>
        <!-- 各ラジオボタンに対応する条件判定 -->
        <td>
            <br>
            <label>避難所としての利用</label>
            <label><input type="radio" name="Shelter" value="○" <?php if (isset($Shelter) && $Shelter === '○') echo 'checked'; ?>> 〇</label>
            <label><input type="radio" name="Shelter" value="×" <?php if (isset($Shelter) && $Shelter === '×') echo 'checked'; ?>> ×</label>
            <label><input type="radio" name="Shelter" value="-" <?php if (isset($Shelter) && $Shelter === '-') echo 'checked'; ?>> -</label>
        </td>
        <!-- 各ラジオボタンに対応する条件判定 -->
        <td>
            <br>
            <label>ペット</label>
            <label><input type="radio" name="petto" value="○" <?php if (isset($petto) && $petto === '○') echo 'checked'; ?>> 〇</label>
            <label><input type="radio" name="petto" value="×" <?php if (isset($petto) && $petto === '×') echo 'checked'; ?>> ×</label>
            <label><input type="radio" name="petto" value="-" <?php if (isset($petto) && $petto === '-') echo 'checked'; ?>> -</label>
        </td>

        <!-- フィルターボタン -->
        <td><input type="submit" name="filter" value="フィルター"></td>
    </tr>
</form>

<!-- データの表示 -->
<table border="1" style="border-collapse: collapse">
    <tr>
        <th>名前</th>
        <th>町</th>
        <th>電話番号</th>
        <!-- 各列に対応するデータベースの列を追加 -->
        <th>土砂災害</th>
        <th>洪水</th>
        <th>津波</th>
        <th>避難所としての利用</th>
        <th>ペット</th>
    </tr>

    <!-- MySQLデータを表示 -->
    <?php foreach ($rec_list_items as $rec) { ?>
        <tr>
            <td><?php echo $rec['name']; ?></td>
            <td><?php echo $rec['town']; ?></td>
            <td><?php echo $rec['telephone']; ?></td>
            <!-- 各列に対応するデータベースの列を追加 -->
            <td><?php echo $rec['dosha']; ?></td>
            <td><?php echo $rec['kouzui']; ?></td>
            <td><?php echo $rec['tunami']; ?></td>
            <td><?php echo $rec['Shelter']; ?></td>
            <td><?php echo $rec['petto']; ?></td>
        </tr>
    <?php } ?>
</table>

<h2>○屋外の緊急避難場所（津波、大火のとき）</h2>

<!-- ラジオボタンのフォーム -->
<form action="nagataku.php" method="POST">
    <tr>
        <td>
            <label>津波</label>
            <label><input type="radio" name="tunami1" value="○" <?php if (isset($tunami1) && $tunami1 === '○') echo 'checked'; ?>> 〇</label>
            <label><input type="radio" name="tunami1" value="×" <?php if (isset($tunami1) && $tunami1 === '×') echo 'checked'; ?>> ×</label>
            <label><input type="radio" name="tunami1" value="-" <?php if (isset($tunami1) && $tunami1 === '-') echo 'checked'; ?>> -</label>
        </td>
        <!-- 各ラジオボタンに対応する条件判定 -->
        <td>
            <br>
            <label>火災</label>
            <label><input type="radio" name="fire" value="○" <?php if (isset($fire) && $fire === '○') echo 'checked'; ?>> 〇</label>
            <label><input type="radio" name="fire" value="×" <?php if (isset($fire) && $fire === '×') echo 'checked'; ?>> ×</label>
            <label><input type="radio" name="fire" value="-" <?php if (isset($fire) && $fire === '-') echo 'checked'; ?>> -</label>
        </td>
        <!-- 各ラジオボタンに対応する条件判定 -->
        <td>
            <br>
            <label>ペット</label>
            <label><input type="radio" name="petto1" value="○" <?php if (isset($petto1) && $petto1 === '○') echo 'checked'; ?>> 〇</label>
            <label><input type="radio" name="petto1" value="×" <?php if (isset($petto1) && $petto1 === '×') echo 'checked'; ?>> ×</label>
            <label><input type="radio" name="petto1" value="-" <?php if (isset($petto1) && $petto1 === '-') echo 'checked'; ?>> -</label>
        </td>

        <!-- フィルターボタン -->
        <td><input type="submit" name="filter" value="フィルター"></td>
    </tr>
</form>

<table border="1" style="border-collapse: collapse">
<tr>
<th>名前</th>
<th>町</th>
<th>津波</th>
<th>火災</th>
<th>ペット</th>
</tr>

<!--MySQLデータを表示-->
<?php foreach ($rec_list_items1 as $rec) { ?>
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