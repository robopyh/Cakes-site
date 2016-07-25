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

    $uploadfile = $uploaddir . basename($_FILES['img']['name']);

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
?>