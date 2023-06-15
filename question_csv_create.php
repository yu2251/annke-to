<?php
// var_dump($_POST);
// exit();

session_start();

// POSTされたトークンを取得
$token = isset($_POST["token"]) ? $_POST["token"] : "";

// セッション変数のトークンを取得
$session_token = isset($_SESSION["token"]) ? $_SESSION["token"] : "";

// セッション変数のトークンを削除
unset($_SESSION["token"]);

// POSTされたトークンとセッション変数のトークンの比較
if($token != "" && $token == $session_token) {
  // 登録画面送信データの登録を行う
  echo"アンケート登録が完了しました";

} else {
  echo"ERROR：不正な登録です";
}

$name = $_POST['name'];
$email = $_POST['email'];
$cat = $_POST['cat'];

$write_data = "{$name} {$email} {$cat}\n";

$file =fopen('cat/cat.csv','a');
flock($file, LOCK_EX);
fwrite($file, $write_data);
flock($file, LOCK_UN);
fclose($file);

header("Location:question_csv_input.php");
exit();
?>