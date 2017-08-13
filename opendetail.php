<?php

session_start();

//2. DB接続します
include("functions.php");
//1.POSTでParamを取得
$id = $_GET["id"]; 
// 作品ID

// var_dump($id);
//2.DB接続など
$pdo = db_con();

//３．データ登録SQL変更
$stmt = $pdo->prepare("SELECT * FROM kashimawork_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //executeは実行

//データ表示

if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    $row = $stmt->fetch();

}

//掲示板
$stmt3 = $pdo->prepare("SELECT * FROM kashimaworkboard WHERE workid=:id");
$stmt3->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status3 = $stmt3->execute(); //executeは実行
//データ表示
if($status3==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt3->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result2 = $stmt3->fetch(PDO::FETCH_ASSOC)){

   $data[] = $result2;
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
  <title>鹿島学園イラスト部</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
  <!--<link rel="stylesheet" href="css/style.css">-->
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
<!-- Head[End] -->

<!-- Main[Start] -->
  <div class="container jumbotron">
<!--<form method="post" action="">-->
    <div class="">
        <p>作品名：<?=$row["workname"]?></p>
        <img src="<?=$row["img"]?>" width="300px"><br>
        <p>所属学校：<?=$row["ownercampus"]?></p>
        <p>作者ニックネーム：<?=$row["workowner"]?></p>
        <p>コメント：<?=$row["comment"]?></p>
        <p>投稿日時：<?=$row["date"]?></p>
    </div>
    <!--</form>-->
    <div class="btn_area">
    <button type="button" class="btn btn-info btn_vote" method="post" id="vote_<?=$row["id"]?>">いいね</button>
    <p class="vote_<?=$row["id"]?>"><?= get_count('vote_$row["id"]') ?></p>
    </div>
  </div>
  
   <div class="container jumbotron">
    <form method="post" action="insertcomment.php">
    <input type="hidden" name="id" value="<?=$id?>">　
         <!--作品IDも一緒に送信-->
    <fieldset>
    <legend>コメントを投稿する</legend>
     <label>コメント<input type="text" name="boardcomment"></label><br>

     <input type="submit" value="送信">
    </fieldset>
    </form>
</div>
<!-- Main[End] -->

<!--掲示板-->
 <div class="container jumbotron">
        <p><?=$row["workname"]?>へのコメント</p>
              <?php foreach ((array) $data as $key => $value): ?>
                    <p><?=h($value["commentnickname"])?>：<?=h($value["boardcomment"])?></p>
                    <!--<p><?=h($value["date"])?></p>-->
                    <a href="deletecomment.php?id=<?=$value['id']; ?>"> 削除 </a>
              <?php endforeach; ?>
        
 </div>


</body>
</html>



