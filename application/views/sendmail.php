<?php

$last_name = isset($_POST["last_name"]) ? $_POST["last_name"] : "";
$first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : "";
$last_name_kana = isset($_POST["last_name_kana"]) ? $_POST["last_name_kana"] : "";
$first_name_kana = isset($_POST["first_name_kana"]) ? $_POST["first_name_kana"] : "";
$b_year = isset($_POST["b_year"]) ? $_POST["b_year"] : "";
$b_month = isset($_POST["b_month"]) ? $_POST["b_month"] : "";
$b_day = isset($_POST["b_day"]) ? $_POST["b_day"] : "";
$age = isset($_POST["age"]) ? $_POST["age"] : "";
$tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$prefecture = isset($_POST["prefecture"]) ? $_POST["prefecture"] : "";
$zip1 = isset($_POST["zip1"]) ? $_POST["zip1"] : "";
$zip2 = isset($_POST["zip2"]) ? $_POST["zip2"] : "";
$address1 = isset($_POST["address1"]) ? $_POST["address1"] : "";
$address2 = isset($_POST["address2"]) ? $_POST["address2"] : "";
$hope = isset($_POST["hope"]) ? $_POST["hope"] : "";
$interview_date = isset($_POST["interview_date"]) ? $_POST["interview_date"] : "";
$method = isset($_POST["method"]) ? $_POST["method"] : "";

if (!empty($job)) {
    $job_title = $job['title'];
    $job_memo = $job['memo'];
} else {
    $job_title = "LPより登録がありました。";
}

// ----- 文字コード
mb_language("uni");
mb_internal_encoding("UTF-8");

// ----- メール送信
//$admin_mail = "s.sugiyama@assertive.co.jp";
$from = "contact@job.ilead-hr.co.jp";
// $admin_mail = "a.ruiz@assertive.co.jp";
// $admin_mail = "h.nakayama@assertive.co.jp";
$admin_mail = "info@ilead-hr.co.jp";

$body = "";

$body .= "【日時】\n";
$body .= date('Y-m-d H:i:s', time()) . "\n";
$body .= $last_name . $first_name . "様\n";
$body .= "
この度はご登録いただき、誠にありがとうございました。

下記の内容を確認させていただき、
担当より3営業日以内に折り返しご連絡させて頂きます。

【ご登録内容】-----------------------------------------
\n";

if (!empty($job)) {
    $body .= $job_title . "\n\n";
}

$body .= '氏名：' . $last_name . $first_name . "\n";
$body .= 'フリガナ：' . $last_name_kana . $first_name_kana . "\n";
$body .= '生年月日：' . $b_year . "-" . $b_month . "-" . $b_day . "\n";
$body .= '年齢：' . $age . "\n";
$body .= '電話番号：' . $tel . "\n";
$body .= 'メールアドレス：' . $email . "\n";
$body .= 'お住まいの地域：' . $zip1 . '-' . $zip2 . $prefecture . $address1 . ' ' . $address2 . "\n";
$body .= '面談希望：' . $hope . "\n";
$body .= '面談希望日：' . $interview_date . "\n";
$body .= '面談方法：' . $method . "\n";

$body .= "
なお、3営業日経ちましてもご連絡がない場合は、
大変お手数ではございますが、下記の電話番号までご連絡をいただけますと幸いです。
\n";
$body .= "06-6210-4371
\n";
$body .= "※本メールはプログラムから自動で送信しており、ご返信いただいても対応できません。
ご不明点がある際は、お手数ですが上記の電話番号までご連絡をお願いいたします。
また、本メールに心当たりのない方は、お手数ですが削除していただければ幸いです。
\n";
$body .= "□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□

アイリード株式会社
TEL : 06–6210–4371
Mail : info@ilead-hr.co.jp
HP : https://ilead-hr.co.jp/

□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□-□
\n";


// ----- 送信処理（お客様宛）
$to = $email;
$header = "From: " . $from;

$subject = "【アイリード株式会社 | 薬剤師のお仕事】に応募ありがとうございます。";
mb_send_mail($to, $subject, $body, $header, "-f" . $from);

$body2 = "";

if (!empty($job)) {
    $body2 .= $job_title . "\n";
    $body2 .= $job_memo . "\n";
    $body2 .= "に応募がありました。\n\n";
} else {
    $body2 .= $job_title . "\n\n";
}

$body2 .= "【ご登録内容】-----------------------------------------\n";

$body2 .= "【日時】\n";
$body2 .= date('Y-m-d H:i:s', time()) . "\n";
$body2 .= "\n";
$body2 .= "【お客様情報】\n";
$body2 .= '氏名：' . $last_name . $first_name . "\n";
$body2 .= 'フリガナ：' . $last_name_kana . $first_name_kana . "\n";
$body2 .= '生年月日：' . $b_year . "-" . $b_month . "-" . $b_day . "\n";
$body2 .= '年齢：' . $age . "\n";
$body2 .= '電話番号：' . $tel . "\n";
$body2 .= 'メールアドレス：' . $email . "\n";
$body2 .= 'お住まいの地域：' . $zip1 . '-' . $zip2 . $prefecture . $address1 . ' ' . $address2 . "\n";
$body2 .= '面談希望：' . $hope . "\n";
$body2 .= '面談希望日：' . $interview_date . "\n";
$body2 .= '面談方法：' . $method . "\n";

// ----- 送信処理（管理者宛）
$to = $admin_mail;
$header = "From: " . $from . "\n";
$subject = "【薬剤師のお仕事】LPより登録がありました。";
mb_send_mail($to, $subject, $body2, $header, "-f" . $from);