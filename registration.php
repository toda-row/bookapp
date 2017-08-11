<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>ユーザー登録</title>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">トップ</a>
        <a class="navbar-brand" href="selectuser.php">ユーザーの一覧</a>
        <a class="navbar-brand" href="selectbook.php">書籍の一覧</a>
        <a class="navbar-brand" href="login.php">ログイン</a>
        </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<!-- Main[Start] -->
<form method="post" action="insertuser.php">
  <div class="container jumbotron">
   <fieldset>
    <legend>新規ユーザー登録する</legend>
     <label>生徒本名：<input type="text" name="studentname"></label><br>
     <label>所属キャンパス：<input type="text" name="campus"></label><br>
     <label>メールアドレス：<input type="text" name="email"></label><br>
     <label>ログインPASS自動発行：<input type="text" name="lpw"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>