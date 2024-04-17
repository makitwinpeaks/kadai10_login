<?php
//1. POSTデータ取得
//＊TODO＊受け取りの項目を増減する。

$nickname = $_POST['nickname'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];
$prefecture = $_POST['prefecture'];
$marital_status = $_POST['marital_status'];
$children = $_POST['children'];

// エラーはvar_dampで確認。
// var_dump($_POST); // formの送信方法に合わせて出力
// exit();

//2. DB接続します 
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
//一度受け取った変数をbindValueでクリーニング（怪しいコマンド等を削除）して、入れなおすための記述。
//*TODO*コピペして使用し、SQLの項目と、bindValueの項目だけ変える。
$sql = "INSERT INTO user_signup(nickname, gender, birthdate, prefecture, marital_status, children,indate)VALUES(:nickname, :gender, :birthdate, :prefecture, :marital_status, :children, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':nickname',        $nickname,         PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':gender',          $gender,           PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':birthdate',       $birthdate,        PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':prefecture',      $prefecture,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':marital_status',  $marital_status,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':children',        $children,         PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute(); //true or false 

//４．データ登録処理後
//*TODO*これはこのままコピペ。
if($status==false){

  sql_error($stmt);

}else{
  
  redirect("index.php");
}
?>
