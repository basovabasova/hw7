<?php
    $list = glob('tests/*.json');
    $filename = 'tests';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Выбрать тест</title>
</head>
<body>
  <?php
      if (file_exists($filename)) {
          foreach ($list as $key => $file) {
              $test = file_get_contents($file);
              $decode = json_decode($test, true);
              echo '<pre>';
              $question = $decode[0]['test'];
              echo "<a href=\"test.php?test=$key\">$question</a><br>";
          }
      } else {
          echo "Папка $filename не существует";
      }       
  ?>
  <p><a href="admin.php">Загрузить тесты</a></p>
  <p><a href="test.php">Пройти тест</a></p>
</body>
</html>