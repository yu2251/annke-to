# プロダクトのタイトル
  好きな猫アンケート

# 概要（どんなものか，どうやって使うか，など）
  名前とメールアドレス、そして好きな猫を選択して登録すると
  アンケートに参加できます
  
# 工夫した点，こだわった点
  ・フォームに入力せずとも猫の写真を選択するだけで任意の値が
    自動的に入力されるようにしました。
  ・誤って連続送信できないように二重送信防止用トークンの発行するようにしました。
  
# 苦戦した点，もう少し実装したかった点
  ・選択されている猫がわかるように青で縁取りするようにしていたのですが
   上手くできませんでした。
  ・前回作った郵便番号のapiを使って住所を登録させるようにしたかったですが、
    これも上手く起動できませんでした。
  ・好きな猫の集計も上手くできませんでした。
    javaScriptもう一度勉強しなおします。
    

# 参考URL
  ・PHPでCSVファイルを読み込む方法
  https://medium-company.com/php-csv%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB-%E8%AA%AD%E3%81%BF%E8%BE%BC%E3%81%BF/
  ・【メールフォームの作り方について、PHPを使って解説
  https://magazine.techacademy.jp/magazine/41842
  ・PHPでフォームの二重送信を防止する方法を現役エンジニアが解説【初心者向け】
  https://qiita.com/daisu_yamazaki/items/7281736f0a77cf8ab664
  ・初心者向け。PHPのPOSTとGETの違いと使い分け
  https://newsite-make.com/php-postget/