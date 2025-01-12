<?php
session_start();
include('db.php');
include('session.php');

if (!isset($_SESSION['users'])) {
    header('Location: whod.php');
    exit();
}

// Обработка формы редактирования данных
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['users']['user_id'];
    $login = $_POST['login'];
    $password = $_POST['password']; // Хешируйте пароль перед сохранением
    $telephone = $_POST['telephone'];

    // Проверьте наличие других полей, если они нужны
    // $age = $_POST['age'];
    // $pol = $_POST['pol'];

    // Хеширование пароля
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    // Подготовка запроса
    $sql = "UPDATE users SET login = ?, password = ?, telephone = ? WHERE user_id = ?";
    $stmt = $db->prepare($sql);
    
    if ($stmt === false) {
        die('Ошибка подготовки: ' . htmlspecialchars($db->error));
    }

    // Привязываем параметры
    $stmt->bind_param('sssi', $login, $password, $telephone, $user_id);
    
    if ($stmt->execute()) {
        echo "<p>Данные успешно обновлены.</p>";
    } else {
        echo "<p>Ошибка обновления данных: " . htmlspecialchars($stmt->error) . "</p>";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'header.php'; ?>
    </header>

    <main>
        <section class="user-recent-bookings">
            <h2>Ваши заказы</h2>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "salon");
            if ($conn->connect_error) {
                die("Ошибка подключения: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM zakaz WHERE username = '" . $_SESSION['users']['login'] . "' ORDER BY zakaz_id DESC LIMIT 2";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="axaxaxaxa">
                        <h1><?php echo htmlspecialchars($row['name']); ?></h1>
                        <h2>Дата: <?php echo htmlspecialchars($row['data']); ?></h2>
                        <h2>Время: <?php echo htmlspecialchars($row['vremia']); ?></h2>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Нет последних заказов.</p>";
            }
            ?>
        </section>

        <div class="profile-container">
            <div class="profile-info">
                <h2>Информация о пользователе</h2>
                <?php
                $sql = "SELECT login, status, user_id, age, pol, telephone FROM users WHERE user_id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("i", $_SESSION['users']['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<p><strong>Логин:</strong> " . htmlspecialchars($row['login']) . "</p>";
                    echo "<p><strong>Статус:</strong> " . htmlspecialchars($row['status']) . "</p>";
                    echo "<p><strong>Телефон:</strong> " . htmlspecialchars($row['telephone']) . "</p>";
                } else {
                    echo "<p>Информация о пользователе не найдена.</p>";
                }
                ?>
            </div>
            <div class="profile-edit">
                <h2>Редактировать данные</h2>
                <form action="" method="post">
                    <label for="login">Логин:</label><input type="text" name="login" id="login" required>
                    <label for="password">Пароль:</label><input type="password" name="password" id="password">
                    <label for="telephone">Телефон:</label><input type="text" name="telephone" id="telephone" required>
                    <button type="submit">Сохранить изменения</button>
                </form>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>

<?php
$db->close();
?>
