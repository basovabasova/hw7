<?php
    $list = glob('tests/*.json');
    $questions = [];
    $answers_true = [];
    $answers = [];

    if (!isset($list[$_GET['test']])) {
        http_response_code(404);  
        exit;
    }

    foreach ($list as $key => $file) {
        if ($key == $_GET['test']) {
            $test = file_get_contents($list[$key]);
            $decode = json_decode($test, true);
        }
    }

    $test_number = $decode[0]['test'];

    foreach ($decode as $value) {
        if (!array_key_exists('test', $value)) {
            $questions[] = $value;
        }
        $answer_true = $value['true'];  
        foreach ($value as $key => $answer) {
            if ($key === $answer_true) {
                $answers_true[] = $answer;
            }   
        }
    }

    foreach ($_POST as $key => $item) {
        if ($key !== 'check') {
            $answers[] = $item;
        }        
    }
   
    $count_true = count(array_intersect($answers, $answers_true));
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title><?=$test_number?></title>
</head>
<body>
  <form method="POST">
    <?php 
        foreach ($questions as $keys => $value) { ?> 
          <fieldset>
            <legend><?php echo $value['question']; ?></legend><br>
              <label><input type="radio" name="<?php echo $keys; ?>" value="<?php echo $value['v1'] ?>"><?php echo $value['v1'] ?></label>
              <label><input type="radio" name="<?php echo $keys; ?>" value="<?php echo $value['v2'] ?>"><?php echo $value['v2']; ?></label>
              <label><input type="radio" name="<?php echo $keys; ?>" value="<?php echo $value['v3'] ?>"><?php echo $value['v3']; ?></label>
              <label><input type="radio" name="<?php echo $keys; ?>" value="<?php echo $value['v4'] ?>"><?php echo $value['v4']; ?></label>
              <label><input type="radio" name="<?php echo $keys; ?>" value="<?php echo $value['v5'] ?>"><?php echo $value['v5']; ?></label>
          </fieldset>
    <?php } ?><br>
    
    <input type="submit" name="check" value="Отправить">
    <hr/>
  </form>
  <?php
      if (!empty($_POST) && $answers) {
          if (!array_diff($answers, $answers_true) && (count($answers) === count($answers_true))) {
              echo 'Тест пройден!' . '<br>' . 'Правильных ответов: ' . $count_true . '<br>'; ?>
              <form action="certificate.php" method="POST">
                <input type="text" name="username" placeholder="Введите ваше имя">
                <input type="submit" name="generate" value="Cертификат">
              </form>
          <?php
          } else {
              echo 'Тест не пройден, попробуйте еще раз.' . '<br>'  . 'Правильных ответов: ' . $count_true . '<br>';
          }          
      }    

      if (isset($_POST['check']) && !$answers) {
          echo "Еще разок!" . '<br>';
      }   
  ?>
  <p><a href="list.php">Выбрать тест</a></p>
</body>
</html>


