<?php
//セッション開始
session_start();

//関数読み込み
include("funcs.php");

//LOGINチェック
sschk();


//SQL作成
$sql = "SELECT * FROM user_signup";
$conditionSet = false;

// 生年月日で降順にソート
if (isset($_POST['sort_by_birthdate'])) {
    $sql .= " ORDER BY birthdate DESC";
    $conditionSet = true;
}

// 未婚で絞り込み
if (isset($_POST['filter_unmarried'])) {
    $sql .= " WHERE marital_status = '未婚'";
    $conditionSet = true;
}

// 既婚で絞り込み
if (isset($_POST['filter_married'])) {
    $sql .= " WHERE marital_status = '既婚'";
    $conditionSet = true;
}



//DB接続
$pdo = db_conn();

//SQLセット
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//条件に合致する全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); 

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー登録情報</title>
   
    <style>
  div{padding: 10px;font-size:16px;}
  td{border: 1px solid black;}
</style>
</head>
<body>
    <h1>
        <?=$_SESSION["name"]?>さん、お疲れ様です！
    </h1>
    <h2>ユーザー登録情報</h2>

    <button onclick="location.href='./index.php'">ユーザー登録に戻る</button>
    <button onclick="location.href='./admin.php'">管理者登録</button>
    <button onclick="location.href='./logout.php'">ログアウト</button>

    <div style="padding-top: 30px">
    <form action="select.php" method="post">
        <button type="submit" name="sort_by_birthdate">生年月日で降順にソート</button>
        <button type="submit" name="filter_unmarried">未婚で絞り込み</button>
        <button type="submit" name="filter_married">既婚で絞り込み</button>
    </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ニックネーム</th>
                <th>性別</th>
                <th>生年月日</th>
                <th>都道府県</th>
                <th>交際ステータス</th>
                <th>子どもの人数</th>
                <th>登録日時</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($values as $v): ?>
            <tr>
                <td><?=h($v["id"])?></td>
                <td><?=h($v["nickname"])?></td>
                <td><?=h($v["gender"])?></td>
                <td><?=h($v["birthdate"])?></td>
                <td><?=h($v["prefecture"])?></td>
                <td><?=h($v["marital_status"])?></td>
                <td><?=h($v["children"])?></td>
                <td><?=h($v["indate"])?></td>

                <!-- セッション情報にあるauth_flgで更新・削除ボタンを出しわける -->
                <?php if($_SESSION["auth_flg"]=="1"){ ?>
                <td><a href="detail.php?id=<?=h($v["id"])?>">更新</a></td>
                <td><a href="delete.php?id=<?=h($v["id"])?>">削除</a></td>
                <?php }?>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>