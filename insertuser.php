<?php

session_start();

//1. POSTデータ取得

$studentname   = $_POST["studentname"];
$campus = $_POST["campus"];
$email = $_POST["email"];
$lpw = $_POST["lpw"];



//2. DB接続します
include("functions.php");
//1.POSTでParamを取得
//$id = $_GET["id"];

//2.DB接続など
$pdo = db_con();


// ３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO 
          kashimauser_table(
            id,
            studentname,
            campus,
            email,
            lpw, 
            kanri_flg, 
            life_flg, 
            date,
            nickname,
            userimg
          )VALUES(
            NULL,
            :studentname,
            :campus,
            :email,
            :lpw, 
            0, 
            0, 
            sysdate(),
            NULL,
            NULL
          )");
          
$stmt->bindValue(':studentname', $studentname, PDO::PARAM_STR); 
$stmt->bindValue(':campus', $campus, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//executeは実行



// メール処理

$add_header="From:yoshihiro.t.88@gmail.com\r\n";
$add_header	.= "Reply-to: yoshihiro.t.88@gmail.com\r\n";
$add_header	.= "X-Mailer: PHP/". phpversion();
$opt = '-f'.'yoshihiro.t.88@gmail.com'; //-fって何か意味あったんだけど忘れました　-fすると迷惑メールになりにくいとか、そんなことだったと思う。

//以下ヒアドキュメント<<<●●　HTMLでも、文字列でも、何いれてもOK●●;
//ヒアドキュメントは、メール送信とかの定型文を書いたりするとき、あとはSQLを書くときも使うかな。
//ヒアドキュメント内ではPHPのプログラムは一切かけない。変数だけ。変数は{}で囲ってあげること
//メールの本文をここでひとまとめに。
$message =<<<HTML
登録内容の確認です。

お名前
{$studentname}

キャンパス名
{$campus}

E_mail
{$email}

パスワード
{$lpw}

登録完了しました。
こちらからログインしてください。
http://itjoho.jp/kashima/login.php

HTML;

// カレントの言語を日本語に設定する
mb_language("ja");
// 内部文字エンコードを設定する　このエンコード指定は大昔の携帯だとShift-jisにしないとだめだったとか。
// 今はUTF-8にしておけばだいたいOKだから、楽な時代になったもんだよ。
mb_internal_encoding("UTF-8");

mb_send_mail($email,"【お問い合わせ】確認メール",$message,$add_header,$opt);
//mb_send_mailは5つの設定項目がある
//mb_send_mail(送信先メールアドレス,"メールのタイトル","メール本文","メールのヘッダーFromとかリプライとか","送信エラーを送るメールアドレス");
//5番目の情報は第5引数と呼ばれるものでして、これがないと迷惑メール扱いになることも。



//マスター管理者にも同じメールを送りつける！！
mb_send_mail('yoshihiro.t.88@gmail.com',"登録がありました",$message,$add_header,$opt);

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError（SQLのエラー）:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  //header("Location: index.php"); 
  //Location:　のあとに必ずスペースが必要
  exit;

}

?>
