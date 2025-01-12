<?php
session_start();
include('db.php');
$login = $_POST['login'];
$password = $_POST['password'];

$query = mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '{$login}' AND `password` = '{$password}'");
if (mysqli_num_rows($query) ==0){

    header("Location:main.php");
} else {
    
    $row = mysqli_fetch_assoc($query);
      $_SESSION['users'] = ['login' => $login, 'status' => $row['status'], 'user_id' => $row['user_id']];
      header("Location:k.php");

}
?>
