<?php
session_start();

// 二重送信防止用トークンの発行
$token = uniqid('', true);;

//トークンをセッション変数にセット
$_SESSION['token'] = $token;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>question</title>
    <style>
        .cat-image {
            width: 100px;
            height: 100px;
            border: 2px solid transparent;
            cursor: pointer;
        }

        .cat-image.selected {
            border-color: blue;
        }
    </style>
</head>
<body>

<form id="inquiry-form" action="question_csv_create.php" method="POST">
    <fieldset>
      <legend>アンケート（入力画面）</legend>
      <a href="question_cvs_read.php">結果一覧</a>
      <div>
        名前: <input type="text" name="name" autocomplete="name" title="名前">
      </div>
      <div>
        email: <input type="text" name="email" autocomplete="email" title="email">
      </div>
        <div>
            好きな猫:
            <input type="radio" id="cat-kizisiro" name="cat" value="キジ白猫" title="好きな猫" style="display: none;">
            <label for="cat-kizisiro">
                <img src="img/kizisiro.jpg" class="cat-image" onclick="selectCatImage(this);" alt="キジ白">
            </label>
            <input type="radio" id="cat-kuro" name="cat" value="黒猫" title="好きな猫" style="display: none;">
            <label for="cat-kuro">
                <img src="img/kuro.jpg" class="cat-image" onclick="selectCatImage(this);" alt="黒">
            </label>
            <input type="radio" id="cat-siron" name="cat" value="白猫" title="好きな猫" style="display: none;">
            <label for="cat-siron">
                <img src="img/siron.jpg" class="cat-image" onclick="selectCatImage(this);" alt="白">
            </label>
            <input type="radio" id="cat-kizi" name="cat" value="キジ猫" title="好きな猫" style="display: none;">
            <label for="cat-kizi">
                <img src="img/kizi.jpg" class="cat-image" onclick="selectCatImage(this);" alt="キジ">
            </label>
        </div>
      <div>
      <input type="hidden" name="token" value="<?php echo $token;?>">
        <button type="submit">submit</button>
      </div>
    </fieldset>
  </form>
  <div>
  <ul id="result"></ul>
  </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>

    function selectCatImage(element) {
        // すべての画像から選択状態を解除
        var catImages = document.getElementsByClassName('cat-image');
        for (var i = 0; i < catImages.length; i++) {
            catImages[i].classList.remove('selected');
        }

        // 選択された画像に選択状態のクラスを追加
        element.classList.add('selected');

        // 選択された画像に対応するラジオボタンをチェックする
        var radioId = element.parentNode.getAttribute('for');
        var radio = document.getElementById(radioId);
        radio.checked = true;
    }
    
  $(document).ready(function () {
    $("#inquiry-form").submit(function (event) {
      event.preventDefault();

      var formData = $(this).serializeArray();
      var jsonData = {};

      $.each(formData, function (_, field) {
        jsonData[field.name] = field.value;
      });

      $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: JSON.stringify(jsonData),
        contentType: "application/json",
        success: function () {
          alert("送信しました。");
          $("#inquiry-form")[0].reset();
        },
        error: function (error) {
          console.log(error);
        },
      });
    });
  });

</body>
</html>