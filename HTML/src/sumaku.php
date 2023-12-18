<?php
// データベース接続
$dsn = 'mysql:dbname=seisaku;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql_list = "SELECT list FROM sumaku_kensaku";
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

// リセットボタンの処理
if (isset($_POST['reset'])){
    $dosha = $kouzui = $tunami = $Shelter = $petto = $tunami1 = $fire = $petto1 = '';
}

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
$sql_items = "SELECT * FROM sumaku_items0 $whereClause";
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
$sql_items1 = "SELECT * FROM sumaku_items1 $whereClause1";
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
    <title>防災宝典</title>
    <link rel="stylesheet" href="../../_common/css/hinan.css">
    <link rel="shortcut icon" href="../../_common/image/ページアイコン.ico"
</head>
<body>
<header>
        <div class="header-container">
            <a href="#">
                <img src="../../_common/image/logo.png" alt="防災宝典" width="300" height="150">
            </a>
        </div>
    </header>

    <nav>
        <div class="nav-container">
            <ul class="globalnav">
                <li><a href="../seisaku1.html" class="btn4">ホーム</a></li>
                <li><a href="../seisaku2.html" class="btn2">避難場所一覧</a></li>
                <li><a href="../seisaku3.html" class="btn4">ボランティア募集</a></li>
                <li><a href="../seisaku4.html" class="btn4">掲示板</a></li>
                <li><a href="../seisaku5.html" class="btn4">チェックリスト</a></li>
                <li><a href="../src/seisaku6.html" class="btn4">ログイン</a></li>
            </ul>
        </div>
    </nav>
    <h2>須磨区</h2>

<!-- 検索 -->
<form action="sumaku.php" method="POST">
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
<a href="http://localhost/seisakujisyu_Y/HTML/src/sumaku.php">検索を解除</a><br />
<?php } ?>
<p>○ その災害時に利用できる施設<br>
× 原則利用できない施設<br>
― その災害による避難を想定していない施設<br></p>
<h2>○屋内の緊急避難場所（土砂災害、洪水、津波のとき）、避難所</h2>

<!-- ラジオボタンのフォーム -->
<form action="sumaku.php" method="POST">
    <tr>
        <td>
            <h3>土砂災害</h3><br>
            <input type="radio" name="dosha" value="○" id="a" <?php if (isset($dosha) && $dosha === '○') echo 'checked'; ?>><label class="dosha" for="a">〇</label>
            <input type="radio" name="dosha" value="×" id="b" <?php if (isset($dosha) && $dosha === '×') echo 'checked'; ?>><label class="dosha" for="b">✕</label>
            <input type="radio" name="dosha" value="-" id="c" <?php if (isset($dosha) && $dosha === '-') echo 'checked'; ?>><label class="dosha" for="c">ー</label>
        </td>
        <!-- 各ラジオボタンに対応する条件判定 -->
        <td>
            <br>
            <h3>洪水</h3><br>
            <input type="radio" name="kouzui" value="○" id="d" <?php if (isset($kouzui) && $kouzui === '○') echo 'checked'; ?>><label class="kouzui" for="d">〇</label>
            <input type="radio" name="kouzui" value="×" id="e" <?php if (isset($kouzui) && $kouzui === '×') echo 'checked'; ?>><label class="kouzui" for="e">✕</label>
            <input type="radio" name="kouzui" value="-" id="f" <?php if (isset($kouzui) && $kouzui === '-') echo 'checked'; ?>><label class="kouzui" for="f">ー</label>
        </td>
        <!-- 各ラジオボタンに対応する条件判定 -->
        <td>
            <br>
            <h3>津波</h3><br>
            <input type="radio" name="tunami" value="○" id="g" <?php if (isset($tunami) && $tunami === '○') echo 'checked'; ?>><label class="tunami" for="g">〇</label>
            <input type="radio" name="tunami" value="×" id="h" <?php if (isset($tunami) && $tunami === '×') echo 'checked'; ?>><label class="tunami" for="h">✕</label>
            <input type="radio" name="tunami" value="-" id="i" <?php if (isset($tunami) && $tunami === '-') echo 'checked'; ?>><label class="tunami" for="i">ー</label>
        </td>
        <!-- 各ラジオボタンに対応する条件判定 -->
        <td>
            <br>
            <h3>避難所としての利用</h3><br>
            <input type="radio" name="Shelter" value="○" id="j" <?php if (isset($Shelter) && $Shelter === '○') echo 'checked'; ?>><label class="Shelter" for="j">〇</label>
            <input type="radio" name="Shelter" value="×" id="k" <?php if (isset($Shelter) && $Shelter === '×') echo 'checked'; ?>><label class="Shelter" for="k">✕</label>
            <input type="radio" name="Shelter" value="-" id="l" <?php if (isset($Shelter) && $Shelter === '-') echo 'checked'; ?>><label class="Shelter" for="l">ー</label>
        </td>
        <!-- 各ラジオボタンに対応する条件判定 -->
        <td>
            <br>
            <h3>ペット</h3><br>
            <input type="radio" name="petto" value="○" id="m" <?php if (isset($petto) && $petto === '○') echo 'checked'; ?>><label class="petto" for="m">〇</label>
            <input type="radio" name="petto" value="×" id="n" <?php if (isset($petto) && $petto === '×') echo 'checked'; ?>><label class="petto" for="n">✕</label>
            <input type="radio" name="petto" value="-" id="o" <?php if (isset($petto) && $petto === '-') echo 'checked'; ?>><label class="petto" for="o">ー</label>
        </td>

        <!-- フィルターボタン -->
        <br>
        <td><input type="submit" name="filter" value="フィルター"></td>
        <!-- リセットボタン -->
        <form action="sumaku.php" method="POST">
            <input type="submit" name="reset" value="リセット">
        </form>
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
<form action="sumaku.php" method="POST">
    <tr>
        <td>
            <h3>津波</h3><br>
            <input type="radio" name="tunami1" value="○" id="p" <?php if (isset($tunami1) && $tunami1 === '○') echo 'checked'; ?>><label class="tunami1" for="p">〇</label>
            <input type="radio" name="tunami1" value="×" id="q" <?php if (isset($tunami1) && $tunami1 === '×') echo 'checked'; ?>><label class="tunami1" for="q">✕</label>
            <input type="radio" name="tunami1" value="-" id="r" <?php if (isset($tunami1) && $tunami1 === '-') echo 'checked'; ?>><label class="tunami1" for="r">ー</label>
        </td>
        <!-- 各ラジオボタンに対応する条件判定 -->
        <td>
        <br>
            <h3>火災</h3><br>
            <input type="radio" name="fire" value="○" id="s" <?php if (isset($fire) && $fire === '○') echo 'checked'; ?>><label class="fire" for="s">〇</label>
            <input type="radio" name="fire" value="×" id="t" <?php if (isset($fire) && $fire === '×') echo 'checked'; ?>><label class="fire" for="t">✕</label>
            <input type="radio" name="fire" value="-" id="u" <?php if (isset($fire) && $fire === '-') echo 'checked'; ?>><label class="fire" for="u">ー</label>
        </td>
        <!-- 各ラジオボタンに対応する条件判定 -->
        <td>
        <br>
            <h3>ペット</h3><br>
            <input type="radio" name="petto1" value="○" id="v" <?php if (isset($petto1) && $petto1 === '○') echo 'checked'; ?>><label class="petto1" for="v">〇</label>
            <input type="radio" name="petto1" value="×" id="w" <?php if (isset($petto1) && $petto1 === '×') echo 'checked'; ?>><label class="petto1" for="w">✕</label>
            <input type="radio" name="petto1" value="-" id="x" <?php if (isset($petto1) && $petto1 === '-') echo 'checked'; ?>><label class="petto1" for="x">ー</label>
        </td>
        <br>
        <!-- フィルターボタン -->
        <td><input type="submit" name="filter" value="フィルター"></td>
        <!-- リセットボタン -->
        <form action="sumaku.php" method="POST">
            <input type="submit" name="reset" value="リセット">
        </form>
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
<footer>
    <div class="footer-container">
    <a href="../src/higasinadaku.php">東灘区</a>
    <a href="../src/tyuuouku.php">中央区</a>
    <a href="../src/nadaku.php">灘区区</a>
    <a href="../src/hyougoku.php">兵庫区</a>
    <a href="../src/kitaku.php">北区</a>
    <a href="../src/nagataku.php">長田区</a>
    <a href="../src/tarumiku.php">垂水区</a>
    <a href="../src/nisiku.php">西区</a>
    </div>
</footer>
</body>
</html>