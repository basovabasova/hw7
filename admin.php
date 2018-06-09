<?php
    foreach ($_FILES as $key => $value) {
        if (isset($_POST) && isset($_FILES)) {
            $file = $value['name'];
            $tmp = $value['tmp_name'];
            $uploaddir = 'tests/';
            $path_info = pathinfo($uploaddir . $file);

            if ($path_info['extension'] === 'json') {
                move_uploaded_file($tmp, $uploaddir . $file);
                //echo 'Файл передан';
                header('refresh:3; url=list.php');
            } else {
                echo 'Файл не передан, нужен файл json.' . '<br>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Загрузить тесты</title>
</head>
<body>
  <form method="post" enctype="multipart/form-data">
    <legend>Загрузить тесты</legend>
      <label><input type="file" name="usefile1"></label>
      <label><input type="file" name="usefile"></label>
    <input type="submit" value="Отправить"><br>
  <p><a href="list.php">Выбрать тест</a></p>
</body>
</html>