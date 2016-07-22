<?php
	
// Страница авторизации

# Функция для генерации случайной строки

function generateCode($length=6) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";

    $code = "";

    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {

            $code .= $chars[mt_rand(0,$clen)];  
    }

    return $code;

}

# Соединямся с БД

$link = mysqli_connect("localhost", "root", "FyNh170794", "cakes");

if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

if($_SERVER['REQUEST_METHOD'] == POST)
{
    # Вытаскиваем из БД запись, у которой логин равняеться введенному

    if (!($result = mysqli_query($link, "SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."' LIMIT 1")))
	{
		printf("Не удалось найти пользователя с таким логином: %s\n", mysqli_connect_error());
		exit();
	}

    $data = mysqli_fetch_assoc($result);


    # Сравниваем пароли
	
	if (password_verify($_POST['password'], $data['user_password']))
    {

        # Хэшируем случайное число

        $hash = sha1(generateCode(10));
		

        #  Записываем в БД новый хэш авторизации

        mysqli_query($link, "UPDATE users SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'");

        

        # Ставим куки

        setcookie("id", $data['user_id'], time()+60*60*24*30);

        setcookie("hash", $hash, time()+60*60*24*30);

        

        # Переадресовываем браузер на страницу проверки нашего скрипта


        header("Location: check.php"); exit();

    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>