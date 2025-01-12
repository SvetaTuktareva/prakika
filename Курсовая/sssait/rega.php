<?php
session_start();
include('db.php');

if ($_POST) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $status = 'user'; 


    $query = mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '{$login}'");
    if (mysqli_num_rows($query) > 0) {
        echo "Ошибка: пользователь с таким логином уже существует.";
    } else {



        $insert_query = mysqli_query($db, "INSERT INTO `users` (`login`, `password`, `status`) VALUES ('{$login}', '{$password}', '{$status}')");

        if ($insert_query) {

            $_SESSION['users'] = [
                'login' => $login,
                'status' => $status,
                'user_id' => mysqli_insert_id($db)
            ];

            header("Location: k.php");
            exit();
        } else {
            echo "Ошибка: не удалось зарегистрировать пользователя.";
        }
    }
}
?>
