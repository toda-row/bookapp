<?php

session_start();

header("Content-type: text/html; charset=utf-8");
 
if(empty($_POST)) {
	header("Location: pdo_search_form.html");
	exit();
}else{
	//名前入力判定
	if (!isset($_POST['search'])  || $_POST['search'] === "" ){
		$errors['name'] = "名前が入力されていません。";
	}
}
 
//1.  DB接続します
include("functions.php");
//1.POSTでParamを取得

//2.DB接続など
$pdo = db_con();


		$statement = $pdo->prepare("SELECT * FROM kashimawork_table WHERE workname LIKE (:workname) ");
	
		if($statement){
			$search = $_POST['search'];
			$like_search = "%".$search."%";
			//プレースホルダへ実際の値を設定する
			$statement->bindValue(':workname', $like_search, PDO::PARAM_STR);
			
			if($statement->execute()){
				//レコード件数取得
				$row_count = $statement->rowCount();
				
				while($row = $statement->fetch()){
					$rows[] = $row;
				}
				
			}else{
				$errors['error'] = "検索失敗しました。";
			}
			
			//データベース接続切断
			$dbh = null;	
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
        <a class="navbar-brand" href="pdo_search_form.html">検索</a>
        

        
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
<?php if (count($errors) === 0): ?>
 
<p><?="『　".htmlspecialchars($search, ENT_QUOTES, 'UTF-8')."　』で検索しました。"?></p>
<p><?=$row_count?>件です。</p>
 
<table class="table table-hover" >
<tr><td>作品画像</td><td>作品名</td><td>作者</td></tr>
 
<?php 
foreach($rows as $row){
?> 
<tr> 
    <a href="opendetail.php?id=<?=$row['id'];?>" >
	<td><img src="<?=$row["img"]?>"  width="100"> </td> 
	<td><?=htmlspecialchars($row['workname'],ENT_QUOTES,'UTF-8')?></td> 
	<td><?=htmlspecialchars($row['workowner'],ENT_QUOTES,'UTF-8')?></td> 
	</a>
</tr> 
<?php 
} 
?>
 
<?php elseif(count($errors) > 0): ?>
<?php
foreach($errors as $value){
	echo "<p>".$value."</p>";
}
?>
<?php endif; ?>
 
    </div>
<!-- work section --> 

<!-- Main[End] -->


</body>
</html>
