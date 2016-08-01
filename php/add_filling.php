<?php

# Соединямся с БД
$link = mysqli_connect("localhost", "root", "FyNh170794", "cakes");

if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    # Валидация полученных данных
    $name = $description = $img = '';

    $name = test_input($_POST['name']);

    if (isset($_POST['description']))
        $description = test_input($_POST['description']);

    if (!preg_match("/^[a-zA-Zа-яА-Я0-9 _-]+$/",$name)){
    //error
    }

    #загрузка файла

    $uploaddir = '../img/upload/fillings/';

    if (!is_dir($uploaddir)){
        mkdir($uploaddir, 0777, true);
    }

    $filename = rus2translit(basename($_FILES['img']['name']));

    $uploadfile = $uploaddir . $filename;

    if (is_writable($uploaddir)){
        if(!move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)){
            //error
        }
    }

    #Добавляем в БД

    if (mysqli_query($link, "INSERT INTO fillings SET filling_name='".$name."', filling_description='".$description."', filling_img='".str_replace('../','',$uploadfile)."'"))
    {
        //успех
        header("Location: ../index.html");
    }
    else
    {
        //print "<b>При добалвении товара произошли следующие ошибки:</b><br>";
        die('Неверный запрос: ' . mysqli_error($link));
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}
?>