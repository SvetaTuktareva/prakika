<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "salon");

if (isset($_POST['book_service'])) {

    if (!isset($_SESSION['users'])) {
        header('Location: whod.php');
        exit();
    }

   $user_id = $_SESSION['users']['login'];
   $bookingDate = $_POST['bookingDate'];
    $bookingTime = $_POST['bookingTime'];
    $serviceName = $_POST['serviceName'];


  $sql = "INSERT INTO zakaz (username, data, vremia, name) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Ошибка подготовки: " . $conn->error);
    }

    $stmt->bind_param("isss", $user_id, $bookingDate, $bookingTime, $serviceName);
    if ($stmt->execute()) {

        header('Location: k.php');
        exit();
    } else {

         header('Location: error.php');
        exit();
    }
   $stmt->close();
   $conn->close();
}
?>
