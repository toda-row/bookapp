<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>ログイン</title>
</head>
<body>

<!-- header[Start] -->
<?php include ('header.php'); ?>
<!-- header[End] -->

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="login_act.php" method="post">
  <div class="container jumbotron">
   <fieldset>
    <legend>ログインする</legend>
     <label>ID（MAIL）:<input type="text" name="email"></label><br>
     <label>PW:<input type="password" name="lpw"></label><br>
     <input type="submit" value="LOGIN">
    </fieldset>
    <a class="navbar-brand" href="registration.php">ユーザー登録がまだの方</a>
  </div>
</form>



</body>
</html>