<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
  <link href="./css/style.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>


<!-- Main[Start] -->
<!-- insert.phpへの送信部分をformタグ内に記述-->

<h1>ユーザー登録</h1>
    <form action="insert.php" method="post">
        <div class="form-group">
            <label for="nickname">ニックネーム:</label>
            <input type="text" id="nickname" name="nickname" required>
        </div>
        <div class="form-group">
            <label for="gender">性別:</label>
            <select id="gender" name="gender">
                <option value="男性">男性</option>
                <option value="女性">女性</option>
                <option value="その他">その他</option>
            </select>
        </div>
        <div class="form-group">
            <label for="birthdate">生年月日:</label>
            <input type="date" id="birthdate" name="birthdate" required>
        </div>
        <div class="form-group">
            <label for="prefecture">お住まいの都道府県:</label>
            <select id="prefecture" name="prefecture">
                <!-- 都道府県のオプションは、例として一部のみ記載 -->
                <option value="東京都">東京都</option>
                <option value="大阪府">大阪府</option>        
            </select>
        </div>
        <div class="form-group">
            <label for="marital_status">交際ステータス:</label>
            <select id="marital_status" name="marital_status">
                <option value="既婚">既婚</option>
                <option value="未婚">未婚</option>
            </select>
        </div>
        <div class="form-group">
            <label for="children">子どもの人数:</label>
            <select id="children" name="children">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <button type="submit">登録</button>
    </form>

<!-- Main[End] -->

<!-- Footer[Start] -->

    <!-- 管理者専用ボタン -->

    <br>
    <button onclick="location.href='./login.php'">管理者ログイン画面</button>

<!-- Footer[End] -->

</body>
</html>
