<!DOCTYPE html>

<?php
session_start();
include('session.php');
include ('header.php');
$conn = mysqli_connect("localhost", "root", "", "salon");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_usluga'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "foto/";
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $fileName;


        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {

            $stmt = $conn->prepare("INSERT INTO uslugi (foto, price, name, opisanie) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('sdss', $fileName, $price, $name, $description);
            $stmt->execute();
        } else {
            echo "Ошибка при загрузке файла.";
        }
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM uslugi WHERE id_uslugi = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
}


if (isset($_POST['update_usluga'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "foto/";
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $fileName;


        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $stmt = $conn->prepare("UPDATE uslugi SET foto = ?, price = ?, name = ?, opisanie = ? WHERE id_uslugi = ?");
            $stmt->bind_param('sdssi', $fileName, $price, $name, $description, $id);
            $stmt->execute();
        } else {
            echo "Ошибка при загрузке файла.";
        }
    } else {
        $stmt = $conn->prepare("UPDATE uslugi SET price = ?, name = ?, opisanie = ? WHERE id_uslugi = ?");
        $stmt->bind_param('sssi', $price, $name, $description, $id);
        $stmt->execute();
    }
}


$result = mysqli_query($conn, "SELECT * FROM uslugi");
?>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ панель</title>

</head>
<body>
  <main>

    <h2>Добавить новую услугу</h2>
    <form action="admpnl.php" method="post" enctype="multipart/form-data">
        Название: <input name="name" type="text" required>
        Описание: <input name="description" type="text" required>
        Цена: <input name="price" type="text" required>
        Изображение: <input type="file" name="image" accept="image/*" required>
        <button type="submit" name="add_usluga">Добавить</button>
    </form>

    <h2>Существующие услуги</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Изображение</th>
            <th>Цена</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Действия</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id_uslugi']; ?></td>
            <td><img src="foto/<?php echo $row['foto']; ?>" width="100"></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['opisanie']; ?></td>
            <td>
                <form action="admpnl.php" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id_uslugi']; ?>">
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                    <input type="text" name="description" value="<?php echo $row['opisanie']; ?>" required>
                    <input type="text" name="price" value="<?php echo $row['price']; ?>" required>
                    <input type="file" name="image">
                    <button type="submit" name="update_usluga">Обновить</button>
                </form>
                <a href="admpnl.php?delete=<?php echo $row['id_uslugi']; ?>">Удалить</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <?php mysqli_close($conn); ?>
  </main>
</body>
<?php include 'footer.php'; ?>
</html>
