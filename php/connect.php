<?php
    # Соединямся с БД
    $link = mysqli_connect("localhost", "root", "FyNh170794", "cakes");

    if (mysqli_connect_errno()) {
        printf("Не удалось подключиться: %s\n", mysqli_connect_error());
        exit();
    }
?>