<?php
$conn = mysqli_connect("localhost", "root", "", "salon");

if ($conn) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];


    if (!empty($_FILES['image']['tmp_name'])) {
        $image = file_get_contents($_FILES['image']['tmp_name']);

        $image = mysqli_real_escape_string($conn, $image); 

        if (!empty($name) && !empty($description) && !empty($price)) {
            $sql = "INSERT INTO uslugi (name, opisanie, prise, image) VALUES ('$name', '$description', '$price', '$image')";
            mysqli_query($conn, $sql);
            header("Location: admpnl.php");
            exit();
        } else {
            echo "Пожалуйста, заполните все поля.";
        }
    } else {
        echo "Пожалуйста, выберите изображение.";
    }
} else {
    echo "Ошибка подключения к базе данных: " . mysqli_connect_error();
}
?>
