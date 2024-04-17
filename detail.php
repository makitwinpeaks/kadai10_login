<?php

$id = $_GET["id"];


//DB接続
include("funcs.php");
$pdo = db_conn();

//SQL作成
$sql = "SELECT * FROM user_signup WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//条件に合致する全データ取得
$v =  $stmt->fetch(); 

?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー更新</title>
  <link href="./css/style.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>


<!-- Main[Start] -->
<!-- insert.phpへの送信部分をformタグ内に記述-->

<h1>ユーザー情報更新</h1>
    <form action="update.php" method="post">
        <div class="form-group">
            <label for="nickname">ニックネーム:</label>
            <input type="text" id="nickname" name="nickname" value="<?=$v["nickname"]?>" required>
        </div>
        <div class="form-group">
            <label for="gender">性別:</label>
            <select id="gender" name="gender">
                <option value="男性" <?= $v["gender"] == "男性" ? "selected" : "" ?>>男性</option>
                <option value="女性" <?= $v["gender"] == "女性" ? "selected" : "" ?>>女性</option>
                <option value="その他" <?= $v["gender"] == "その他" ? "selected" : "" ?>>その他</option>
            </select>
        </div>
        <div class="form-group">
            <label for="birthdate">生年月日:</label>
            <input type="date" id="birthdate" name="birthdate" value="<?=$v["birthdate"]?>" required>
        </div>
        <div class="form-group">
            <label for="prefecture">お住まいの都道府県:</label>
            <select id="prefecture" name="prefecture">
                <option value="東京都" <?= $v["prefecture"] == "東京都" ? "selected" : "" ?>>東京都</option>
                <option value="大阪府" <?= $v["prefecture"] == "大阪府" ? "selected" : "" ?>>大阪府</option>
    <!-- 他の都道府県も同様に -->
            </select>
        </div>
        <div class="form-group">
            <label for="marital_status">交際ステータス:</label>
            <select id="marital_status" name="marital_status">
                <option value="既婚" <?= $v["marital_status"] == "既婚" ? "selected" : "" ?>>既婚</option>
                <option value="未婚" <?= $v["marital_status"] == "未婚" ? "selected" : "" ?>>未婚</option>
            </select>
        </div>
        <div class="form-group">
            <label for="children">子どもの人数:</label>
            <select id="children" name="children">
                <option value="0" <?= $v["children"] == "0" ? "selected" : "" ?>>0</option>
                <option value="1" <?= $v["children"] == "1" ? "selected" : "" ?>>1</option>
                <option value="2" <?= $v["children"] == "2" ? "selected" : "" ?>>2</option>
                <option value="3" <?= $v["children"] == "3" ? "selected" : "" ?>>3</option>
                <option value="4" <?= $v["children"] == "4" ? "selected" : "" ?>>4</option>
                <option value="5" <?= $v["children"] == "5" ? "selected" : "" ?>>5</option>
            </select>
        </div>
        <button type="submit">更新</button>
        <!-- hiddenにして裏でどのユーザーのデータかわかるようにする -->
        <input type="hidden" name="id" value="<?=$v["id"]?>">
    </form>

<!-- Main[End] -->

<!-- Footer[Start] -->

    <!-- 管理者専用ボタン -->

    <br>
    <button onclick="location.href='./select.php'">管理者専用: 登録情報一覧表示</button>

<!-- Footer[End] -->

</body>
</html>

