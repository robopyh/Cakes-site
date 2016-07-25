<?php

// Страница регситрации нового пользователя

if($_SERVER['REQUEST_METHOD'] == POST)
{
    $err = array();

    # проверям логин

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['login']) < 5 or strlen($_POST['login']) > 20)
    {
        $err[] = "Логин должен быть не меньше 5 символов, но не больше 20";
    }

    # проверяем, не сущестует ли пользователя с таким именем

    $query = mysqli_query($link, "SELECT * FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
	
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует";
    }
	
    # Если нет ошибок, то добавляем в БД нового пользователя

    if(count($err) == 0)
    { 
        $login = $_POST['login'];
		
		printf("Login: %s\n", $login);
		
        # Хэшируем пароль

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		printf("Login: %s\n", $password);

	if (mysqli_query($link, "INSERT INTO users SET user_login='".$login."', user_password='".$password."'") !== TRUE)
	{
		printf("Запись не добавлена в базу данных (%s).\n", mysqli_error($link));
	}

        header("Location: ../index.html");
        exit();
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";

        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?>