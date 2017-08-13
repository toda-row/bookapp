<?php

session_start();

//1.  DB接続します
include("functions.php");
//1.POSTでParamを取得

//2.DB接続など
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM kashimawork_table");

//baintvalue で検索

$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){

   $data[] = $result;
  }

}

// カウント数取得関数
function get_count($file) {
	$filename = 'data/'.$file.'.dat';
	$fp = @fopen($filename, 'r');
	if ($fp) {
		$vote = fgets($fp, 9182);
	} else {
		$vote = 0;
	}
	return $vote;
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
　<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>鹿島学園イラスト部</title>
  <link rel="stylesheet" href="">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(function() {
	allowAjax = true;
	$('.btn_vote').click(function() {
		if (allowAjax) {
			allowAjax = false;
			$(this).toggleClass('on');
			var id = $(this).attr('id');
			$(this).hasClass('on') ? Vote(id, 'plus') : Vote(id, 'minus');
		}
	});
});
function Vote(id, plus) {
	cls = $('.' + id);
	cls_num = Number(cls.html());
	count = plus == 'minus' ? cls_num - 1 : cls_num + 1;
	$.post('vote.php', {'file': id, 'count': count}, function(data) {
		if (data == 'success') cls.html(count);
		setTimeout(function() {
			allowAjax = true;
		}, 1000);
	});
}
</script>

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
                echo 'ようこそ ', $_SESSION['nickname'], ' さん';
                ?>
            </a>
        <?php } ?>
<!--        ユーザーのログイン・ログアウト表示-->
<form class="navbar-brand"  action="searchresult.php" method="post">
<input type="text" name="search">
<input type="submit" value="検索">
</form>
        </div>
    </div>
  </nav>
</header>


<!-- Main[Start] -->
<!-- work section -->
<div class="container jumbotron">

<p>登録作品一覧</p>
<section id="works" class="works section no-padding">
    <div class="container-fluid">
        <div class="row no-gutter">
        <?php foreach ((array) $data as $key => $value): ?>
            <div class="col-lg-3 col-md-4 col-sm-4 work">
                <a href="opendetail.php?id=<?=$value['id'];?>" class="work-box">
                    <img src="<?=$value["img"]?>" alt="">        
    
                    <div class="overlay">
                        <div class="overlay-caption">
                            <h3><?=h($value['workname'])?></h3>
                            <p><?='[' . h($value['manthday']) . ']'?></p>
                            <p><?='[' . h($value['workowner']) . ']'?></p>
                            <a class="btn btn-info btn_vote" method="post" id="vote_<?=$value["id"]?>"> [いいね] </a>
                            <a class="vote_<?=$value["id"]?>">  <?= get_count('vote_<?=$value["id"]?>') ?></a>

                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</section>
    </div>
<!-- work section --> 

<!-- Main[End] -->


</body>
</html>
