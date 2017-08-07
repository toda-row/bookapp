<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
　<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>鹿島学園イラスト部</title>
  <link rel="stylesheet" href="">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">

</head>
<body>


<!-- Head[Start] -->

<!-- Head[End] -->

<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">トップ</a>
        <a class="navbar-brand" href="selectbook.php">作品の一覧</a>
        <a class="navbar-brand" href="selectbook.php">お知らせ</a>
        
<!--        管理者のユーザー管理表示-->
<!--
        <?php
            if(
                $_SESSION['kanri_flg']==1
            ) {
        ?>

        <?php } else { ?>
            空白
        <?php } ?>
-->
<!--        管理者のユーザー管理表示-->

<!--        ユーザーのログイン・ログアウト表示-->
        <?php
            if(
                !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()
            ) {
        ?>
            <a class="navbar-brand" href="login.php">ログイン</a>
            <a class="navbar-brand" href="registration.php">ユーザー登録</a>            
        <?php } else { ?>
            <a class="navbar-brand" href="logout.php">ログアウト</a>
            <a class="navbar-brand" href="">
               <?php
                echo 'ようこそ ', $_SESSION['name'], ' さん';
                ?>
            </a>
        <?php } ?>
<!--        ユーザーのログイン・ログアウト表示-->
        </div>
    </div>
  </nav>
</header>


<!-- Main[Start] -->
<!-- work section -->
<div class="container jumbotron">
<div id="contentes">
     
    <p>送信完了しました。</p>
    <p>入力されたメールアドレスに自動返信メールが送信されました。<br>ご確認下さい。</p>
     
    <p><a href="index.php" target="_blank">戻る</a></p>
     
</div> 

    </div>
<!-- work section --> 

<!-- Main[End] -->


</body>
</html>
