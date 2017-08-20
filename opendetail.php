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
function get_count($voteid) {
	$filename = 'data/'.$voteid.'.dat';
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
  <link href="css/main.css" rel="stylesheet" >
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(function() {
	allowAjax = true;
	$('.btn_vote').click(function() {
		if (allowAjax) {
			allowAjax = false;
			$(this).toggleClass('on');
			var voteid = $(this).attr('id');
			$(this).hasClass('on') ? Vote(voteid, 'plus') : Vote(voteid, 'minus');
		}
	});
});
function Vote(voteid, plus) {
	cls = $('.' + voteid);
	cls_num = Number(cls.html());
	count = plus == 'minus' ? cls_num - 1 : cls_num + 1;
	$.post('vote.php', {'file': voteid, 'count': count}, function(data) {
		if (data == 'success') cls.html(count);
		setTimeout(function() {
			allowAjax = true;
		}, 1000);
	});
}
</script>
</head>
<body>

<!-- header[Start] -->
<?php include ('header.php'); ?>
<!-- header[End] -->

<div class="container jumbotron">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 workwindow" >
            <p>作品名：<?=$row["workname"]?></p>
            <div class="workimg"><img src="<?=$row["img"]?>"></div>
            <p class="iinebutton">
                <button type="button" class="btn btn-info btn_vote" method="post" id="vote_<?=$row["id"]?>">いいね</button>
                <span class="vote_<?=$row["id"]?>"><?= get_count("vote_{$row['id']}") ?></span>
            </p>
        </div>
        <div class="workdetail">
            <p>所属学校：<?=$row["ownercampus"]?></p>
            <p>作者ニックネーム：<?=$row["workowner"]?></p>
            <p>コメント：<?=$row["comment"]?></p>
            <p>投稿日時：<?=$row["date"]?></p>
        </div>
    </div>

    <div class="boardpush">
        <form method="post" action="insertcomment.php">
            <input type="hidden" name="workid" value="<?=$id?>"> <!--作品IDも一緒に送信-->
            <fieldset>
                <legend>コメントを投稿する</legend>
                 <label>コメント<input type="text" name="boardcomment"></label>
                 <input type="submit" value="送信">
            </fieldset>
        </form>
    </div>
    <div class="boardcontainer"></div>
</div>
<!-- Main[Start] -->

  
<!-- Main[End] -->

<!--掲示板-->
 <div class="container jumbotron">
        <p><?=$row["workname"]?>へのコメント</p>
              <?php foreach ((array) $data as $key => $value): ?>
                    <p class="comment">
                        <?=h($value["commentnickname"])?>：<?=h($value["boardcomment"])?>
                        
                        <?php
                            if(
                                !isset($_SESSION["studentname"]) || $_SESSION["studentname"]!=session_id()
                            ) {
                        ?>
                        
                        <a href="deletecomment.php?id=<?=$value['comment_id']?>"> 削除 </a>
                        <?php } else { ?>
                        <!--空白-->
                        <?php } ?>
                    </p>
                    
              <?php endforeach; ?>
     
        
 </div>


</body>
</html>