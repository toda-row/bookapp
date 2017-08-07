<?php
session_start();

//1. POSTデータ取得
$id = $_POST["id"];//作品ID
$workname = $_POST["workname"];
$comment = $_POST["comment"];
//var_dump($_POST);

//***FileUpload
if(isset($_FILES['filename']) && $_FILES['filename']['error']==0){
    $upload_file = "./upload/".$_FILES["filename"]["name"];
    if (move_uploaded_file($_FILES["filename"]['tmp_name'],$upload_file)){
        chmod($upload_file,0644);
    }else{
        echo "fileuploadOK...Failed";
    }
}else{
    echo "fileupload失敗";
}


//2. DB接続します
include("functions.php");

//2.DB接続など
$pdo = db_con();


//３．データ登録SQL変更
$update = $pdo->prepare(
  "UPDATE kashimawork_table SET 
    workname=:workname,
    comment=:comment,
    img=:img
    WHERE id=:id"
  );


$update->bindValue(':id', $id, PDO::PARAM_INT);
$update->bindValue(':workname', $workname, PDO::PARAM_STR);
$update->bindValue(':comment', $comment, PDO::PARAM_STR);
$update->bindValue(':img',$upload_file, PDO::PARAM_STR);
$status = $update->execute(); //executeは実行

//データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $update->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    header("Location: selectbook.php");
    exit;

}

?>