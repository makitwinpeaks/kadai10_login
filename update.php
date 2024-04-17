    <?php
    //PHP:コード記述/修正の流れ
    //1. insert.phpの処理をマルっとコピー。
    //   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
    //2. $id = POST["id"]を追加
    //3. SQL修正
    //   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
    //   bindValueにも「id」の項目を追加
    //4. header関数"Location"を「select.php」に変更

    session_start();

    //1. POSTデータ取得
 
$nickname = $_POST['nickname'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];
$prefecture = $_POST['prefecture'];
$marital_status = $_POST['marital_status'];
$children = $_POST['children'];
//データ更新なのでidも受け取る
$id = $_POST['id'];



// エラーはvar_dampで確認。
// var_dump($_POST); // formの送信方法に合わせて出力
// exit();

//2. DB接続します 
include("funcs.php");
sschk();
$pdo = db_conn();

//３．データ登録SQL作成
//一度受け取った変数をbindValueでクリーニング（怪しいコマンド等を削除）して、入れなおすための記述。
//*TODO*コピペして使用し、SQLの項目と、bindValueの項目だけ変える。

$sql = "UPDATE user_signup SET nickname=:nickname, gender=:gender, birthdate=:birthdate, prefecture=:prefecture, marital_status=:marital_status, children=:children, indate=sysdate() WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':nickname',        $nickname,         PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':gender',          $gender,           PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':birthdate',       $birthdate,        PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':prefecture',      $prefecture,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':marital_status',  $marital_status,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':children',        $children,         PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',              $id,         PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute(); //true or false 

//４．データ登録処理後
//*TODO*これはこのままコピペ。
if($status==false){

  sql_error($stmt);

}else{
  
  redirect("select.php");
}




    ?>
