<?php
session_start();

include("functions.php");
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["workname"]) || $_POST["workname"]=="" ||
  !isset($_POST["comment"]) || $_POST["comment"]==""
){
  exit('ParamError');
}


$workname   = $_POST["workname"];
$comment = $_POST["comment"];
$userid = $_SESSION["anything"];
$workowner = $_SESSION["nickname"];
$studentname = $_SESSION["studentname"];
$campus = $_SESSION["campus"];

var_dump($campus);
var_dump($workowner);

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


//2.DB接続など
$pdo = db_con();


//３．データ登録SQL作成
$sql = "INSERT
          INTO kashimawork_table
               (id,
                workname,
                comment,
                date,
                img,
                userid,
                manthday,
                workowner,
                studentname,
                ownercampus)
        VALUES (NULL,
                :workname,
                :comment,
                sysdate(),
                :img,
                :userid,
                sysdate(),
                :workowner,
                :studentname,
                :campus)";
    
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':workname', $workname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

$stmt->bindValue(':img',$upload_file, PDO::PARAM_STR);
$stmt->bindValue(':userid',$userid, PDO::PARAM_INT);
$stmt->bindValue(':workowner',$workowner, PDO::PARAM_STR);
$stmt->bindValue(':studentname',$studentname, PDO::PARAM_STR);
$stmt->bindValue(':campus',$campus, PDO::PARAM_STR);

$status = $stmt->execute(); //executeは実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError（SQLのエラー）:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: selectwork.php"); //Location:　のあとに必ずスペースが必要
  exit;

}
?>
