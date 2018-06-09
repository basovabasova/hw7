<?php
    $code = "Тест пройден!\n{$_POST['username']}, ваша оценка 47!";
    
    $image = imagecreatetruecolor(650, 256);
    $backcolor = imagecolorallocate($image, 157, 191, 163);
    $textcolor = imagecolorallocate($image, 7, 44, 122);
    
    $boxFile = __DIR__ . '/books.png';
    if (!file_exists($boxFile)) {
        echo 'Файл с картинкой не найден';
        exit;
    }
    
    $imBox = imagecreatefrompng($boxFile);

    imagefill($image, 0, 0, $backcolor);
    imagecopy($image, $imBox, 380, 0, 0, 0, 256, 256);

    $fontFile = __DIR__ . '/font.ttf';
    if (!file_exists($fontFile)) {
        echo 'Файл с шрифтом не найден';
        exit;
    }

    imagettftext($image, 25, 0, 20, 118, $textcolor, $fontFile, $code);
    header('Content-Type: image/png');

    imagepng($image);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>hw7</title>
</head>
<body>
</body>
</html>
