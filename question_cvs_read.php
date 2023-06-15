<?php

$str = array(); // 空の配列を用意
$file = fopen('cat/cat.csv','r');

flock($file, LOCK_EX);

// fgets()で1行ずつ取得→$lineに格納

if ($file) {
  while ($line = fgetcsv($file)) {
    $row = array();
    foreach ($line as $cell) {
      $row[] = $cell; // 行のデータを配列に追加
    }
    $str[] = $row; // 行データを配列に追加
  }
}

flock($file, LOCK_UN);
fclose($file);

// JSON 形式に変換
$jsonData = json_encode($str);

// JSON 文字列を PHP の配列にデコード
$data = json_decode($jsonData, true); // true を指定して連想配列としてデコード

// 項目ごとの回答の分布を格納する配列
$distribution = array();

// 各項目の回答の分布をカウント
foreach ($data as $row) {
  foreach ($row as $index => $answer) {
    // 項目がまだ配列に存在しない場合は初期化
    if (!isset($distribution[$index])) {
      $distribution[$index] = array();
    }
    // 回答をカウント
    if (!isset($distribution[$index][$answer])) {
      $distribution[$index][$answer] = 1;
    } else {
      $distribution[$index][$answer]++;
    }
  }
}

// 分布結果の表示
foreach ($distribution as $index => $answers) {
  echo "項目" . ($index + 1) . "の回答の分布:<br>";
  foreach ($answers as $answer => $count) {
    echo $answer . ": " . $count . "回<br>";
  }
  echo "<br>";
}
?>