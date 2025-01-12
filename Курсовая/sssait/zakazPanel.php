<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "salon");


if (!isset($_SESSION['users']) || $_SESSION['users']['status'] !== 'admin') {
    header('Location: whod.php');
    exit();
}


if (isset($_POST['delete_booking'])) {
    $booking_id = $_POST['booking_id'];
    $sql = "DELETE FROM zakaz WHERE zakaz_id = ?";
   $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    if ($stmt->execute()) {

    } else {

    }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ панель - Заказы</title>

</head>
<body>
    <header>
        <?php include 'header.php'; ?>
    </header>
    <main>

        <h1>Админ панель - Заказы</h1>
        <table border="1">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Услуга</th>
                    <th>Дата</th>
                   <th>Время</th>
                     <th>Пользователь</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT zakaz_id, name, data, vremia, username FROM zakaz";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                       while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['zakaz_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['data']); ?></td>
                            <td><?php echo htmlspecialchars($row['vremia']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                           <td>
                                <form action="zakazPanel.php" method="post" class="delete-form">
                                  <input type="hidden" name="booking_id" value="<?php echo $row['zakaz_id']; ?>">
                                    <button type="submit" name="delete_booking">Удалить</button>
                                </form>
                           </td>
                        </tr>
                   <?php
                     }
                     } else {
                       echo "<tr><td colspan='6'>Нет заказов.</td></tr>";
                  }
                ?>
            </tbody>
        </table>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
