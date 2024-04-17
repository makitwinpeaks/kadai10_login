<?php
session_start();
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sschk();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>管理者登録</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
    <?php echo $_SESSION["name"]; ?>さん、お疲れ様です！
    <!-- <?php include("menu.php"); ?> -->
    <br>
    <button onclick="location.href='./index.php'">ユーザー登録に戻る</button>
    <button onclick="location.href='./logout.php'">ログアウト</button>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="admin_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>管理者登録</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>Login ID：<input type="text" name="lid"></label><br>
     <label>Login PW<input type="text" name="lpw"></label><br>
     <label>権限FLG：
      閲覧のみ<input type="radio" name="auth_flg" value="0">　
      閲覧・編集<input type="radio" name="auth_flg" value="1">
    </label>
    <br>
     <!-- <label>退会FLG：<input type="text" name="life_flg"></label><br> -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
