<php? 

<!--// 【１】文字コードを設定-->
header("Content-Type: text/html;charset=utf-8");
mb_language('ja');
mb_internal_encoding( "utf-8" );
 
<!--//【２】HTMLエンティティ変換-->
$name2 = htmlspecialchars($_POST[entry_name], ENT_QUOTES);
$age = htmlspecialchars($_POST[entry_age], ENT_QUOTES);
$email = htmlspecialchars($_POST[entry_email], ENT_QUOTES);
$lang = htmlspecialchars($_POST[entry_lang], ENT_QUOTES);
$message2 = htmlspecialchars($_POST[entry_message], ENT_QUOTES);
 
$name = mb_convert_kana($name2,"sKV");      
<!--//「名前」半角カナ→全角カナ-->
$message = mb_convert_kana($message2,"sKV");
<!--//「メッセージ」半角カナ→全角カナ-->


<!--//管理者受信用メール送信処理-->
function funcManagerAddress($name,$age,$email,$lang,$message){
    $mailto = $email;      
    <!--//送信先メールアドレス-->
    $subject = "ときどきWEB｜テスト受信メール"; 
    <!--//メール件名-->
    <!--//本文-->
    $content="
    『ときどきweb｜PHPでmb_send_mail関数使って送信者に自動返信機能付きメールフォーム作ってやんよ!!!』の
    テストフォームからの送信メールです\n"
    ."【お名前】： ".$name."\n"
    ."【年齢】： ".$age."才\n"
    ."【メールアドレス】： ".$email."\n"
    ."【現在最も興味のある言語】： ".$lang."\n"
    ."【メッセージ】： ".$message."\n\n";
    
    $mailfrom="From:" .mb_encode_mimeheader($name) ."<".$email.">";
    if(mb_send_mail($mailto,$subject,$content,$mailfrom) == true){
        $managerFlag = "○";
    }else{
        $managerFlag = "×";
    }
    return $managerFlag;
};


<!--//送信者への送信者用自動返信メール送信処理-->
function funcContactAddress($name,$age,$email,$lang,$message){  
    <!--//ヘッダー用変数-->
    $mailto = $email;       
    <!--//送信先メールアドレス-->
    $subject = "ときどきWEB｜自動返信メール";  
    <!--//メール件名-->
    <!--//本文-->
    $content="
    『ときどきweb｜PHPでmb_send_mail関数使って送信者に自動返信機能付きメールフォーム作ってやんよ!!!』の
    テストフォームから以下の内容で受け付けました。\n"
    ."【お名前】： "
    .$name."\n"."【年齢】： ".$age."才\n"
    ."【メールアドレス】： ".$email."\n"
    ."【現在最も興味のある言語】： ".$lang."\n"
    ."【メッセージ】： ".$message."\n\nご入力ありがとうございました。\n";
    
    $mailfrom="From:" .mb_encode_mimeheader("ときどきweb") ."<"管理者のメールアドレス">";
     
    if(mb_send_mail($mailto,$subject,$content,$mailfrom) == true){
        $contactFlag = "○";
    }else{
        $contactFlag = "×";
    }
    return $contactFlag;
};

<!--//送信者用自動返信メール送信-->
$contactAddress = funcContactAddress($name,$age,$email,$lang,$message);
<!--//管理者受信用メール送信-->
$managerAddress = funcManagerAddress($name,$age,$email,$lang,$message);
 
if($contactAddress === "○" && $managerAddress === "○" ){
    <!--//送信メール送信・自動返信が成功したら完了ページへリダイレクト-->
    header("Location: http://●●●/finish.html");
}else{
    <!--//送信メール送信・自動返信のいずれかが失敗したらエラー出力-->
    echo '送信に失敗しました。\nお手数ですが、再度ご入力をお願いします。\n<a href="http://●●●/entry.html">入力ページへ戻る\n';
    print_r($contactAddress);
    print_r($managerAddress);
}

?>