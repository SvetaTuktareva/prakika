
<?php

session_start();
include('header.php');
include('session.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "salon";


$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");


if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == 'add') {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $username = $_POST['username'];
        $status = $_POST['status'];
        $telephone = $_POST['telephone'];
        $age = $_POST['age'];
        $pol = $_POST['pol'];
        $sql = "INSERT INTO users (login, password, username, status, telephone, age, pol) VALUES ('$login', '$password', '$username', '$status', '$telephone', '$age', '$pol')";


        if ($conn->query($sql) === TRUE) {
            header("Location: usersi.php");
            exit();
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    }

    if ($action == 'edit') {
        $user_id = $_POST['user_id'];
        $login = $_POST['login'];
        $username = $_POST['username'];
        $status = $_POST['status'];
        $telephone = $_POST['telephone'];
        $age = $_POST['age'];
         $pol = $_POST['pol'];
        $sql = "UPDATE users SET login='$login', username='$username', status='$status', telephone='$telephone', age='$age', pol='$pol' WHERE user_id=$user_id";


        if ($conn->query($sql) === TRUE) {
            header("Location: usersi.php");
            exit();
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    }
    if ($action == 'delete') {
        $user_id = $_POST['user_id'];
        $sql = "DELETE FROM users WHERE user_id=$user_id";

        if ($conn->query($sql) === TRUE) {
            header("Location: usersi.php");
            exit();
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    }
}


$sql = "SELECT * FROM users ORDER BY user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель: Пользователи</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { width: 90%; max-width: 1200px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .action-buttons { display: flex; gap: 5px; }
        .action-buttons button { background-color: #007bff; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px; }
        .action-buttons button.delete { background-color: #dc3545; }
        .action-buttons button:hover { opacity: 0.8; }
        .add-form { margin-bottom: 20px; }
        .add-form input, .add-form select { padding: 8px; margin-right: 5px; margin-bottom: 5px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .add-form button { background-color: #4CAF50; color: white; border: none; padding: 8px 15px; cursor: pointer; border-radius: 4px; }
        .add-form button:hover { opacity: 0.8; }
    </style>
</head>
<body>
  <main>
<div class="container">
    <h1>Управление пользователями</h1>


    <div class="add-form">
        <h2>Добавить пользователя</h2>
        <form method="post">
            <input type="hidden" name="action" value="add">
            <input type="text" name="login" placeholder="Логин" required>
            <input type="text" name="password" placeholder="Пароль" required>
            <input type="text" name="username" placeholder="Имя пользователя" required>
            <select name="status">
                <option value="user">Пользователь</option>
                <option value="admin">Админ</option>
            </select>
             <input type="text" name="telephone" placeholder="Телефон">
               <input type="number" name="age" placeholder="Возраст">
            <select name="pol">
              <option value="мужской">Мужской</option>
               <option value="женский">Женский</option>
            </select>
            <button type="submit">Добавить</button>
        </form>
    </div>


    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Логин</th>
             <th>Имя</th>
            <th>Статус</th>
               <th>Телефон</th>
               <th>Возраст</th>
               <th>Пол</th>
            <th>редактировать</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['user_id'] . "</td>";
                 echo "<td>" . $row['login'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                  echo "<td>" . $row['telephone'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
                echo "<td>" . $row['pol'] . "</td>";
                echo "<td>";
                echo "<div class='action-buttons'>";
              
                echo "<form method='post'>";
                echo "<input type='hidden' name='action' value='edit'>";
                echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";
                 echo "<input type='text' name='login' value='" . $row['login'] . "' placeholder='Логин' required>";
                 echo "<input type='text' name='username' value='" . $row['username'] . "' placeholder='Имя' required>";
                 echo "<select name='status'>";
                    echo "<option value='user' " . ($row['status'] == 'user' ? 'selected' : '') . ">Пользователь</option>";
                     echo "<option value='admin' " . ($row['status'] == 'admin' ? 'selected' : '') . ">Админ</option>";
                    echo "</select>";
                    echo "<input type='text' name='telephone' value='" . $row['telephone'] . "' placeholder='Телефон'>";
                        echo "<input type='number' name='age' value='" . $row['age'] . "' placeholder='Возраст'>";
                        echo "<select name='pol'>";
                         echo "<option value='мужской' " . ($row['pol'] == 'мужской' ? 'selected' : '') . ">Мужской</option>";
                        echo "<option value='женский' " . ($row['pol'] == 'женский' ? 'selected' : '') . ">Женский</option>";
                        echo "</select>";
                echo "<button type='submit'>Сохранить</button>";
                echo "</form>";

                echo "<form method='post'>";
                echo "<input type='hidden' name='action' value='delete'>";
                echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";
                echo "<button type='submit' class='delete'>Удалить</button>";
                echo "</form>";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Нет пользователей</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</main>
<?php
include('footer.php');
?>
</body>


</html>
<?php
$conn->close();
?>
