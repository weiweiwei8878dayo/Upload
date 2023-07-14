<?php
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // ファイルが実際に画像かどうかをチェックする
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
      echo "ファイルは画像です - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "ファイルは画像ではありません。";
      $uploadOk = 0;
    }
  }

  // 既存のファイルが存在する場合に上書きするかどうかをチェックする
  if (file_exists($target_file)) {
    echo "同名のファイルが既に存在します。";
    $uploadOk = 0;
  }

  // ファイルサイズの制限を設定する
  if ($_FILES["image"]["size"] > 500000) {
    echo "ファイルが大きすぎます。";
    $uploadOk = 0;
  }

  // 特定のファイル形式のみを許可する場合、以下のコメントアウトを解除します
  /*
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "JPEG, JPG, PNG, GIF ファイルのみアップロードできます。";
    $uploadOk = 0;
  }
  */

  // エラーチェック後、ファイルをアップロードする
  if ($uploadOk == 0) {
    echo "ファイルはアップロードされませんでした。";
  } else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      echo "ファイルがアップロードされました。";
    } else {
      echo "ファイルのアップロード中にエラーが発生しました。";
    }
  }
?>
