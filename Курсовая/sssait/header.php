<!DOCTYPE html>
<?php

include('db.php');
if (isset($_GET['logout'])) {
  session_destroy();
  session_unset();
  header('Location: main.php');
  exit();
}
?>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Интернет-магазин</title>
  <link rel="stylesheet" href="header.php">


<style>
header {
    background-color: #333;
    color: white;
    padding: 18px;
    text-align: center;

}
nav {
    margin: auto;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
li {
    display: inline;
    margin-right: 29px;
}
a {
    text-decoration: none;
    color: inherit;
}
</style>


</head>
<body>
  <header>
      <nav>
          <ul>
              <li><a href="main.php">Главная</a></li>
              <li><a href="kat.php">Каталог</a></li>

              <?php if (isset($_SESSION['users']) && isset($_SESSION['users']['login'])){ ?>
                <li><a href="main.php?logout=1">Выход</a>
                <li><a href="k.php">Кабинет</a></li>
                <?php if (($_SESSION['users']['status']) == 'admin'){ ?>
                    <li><a href="admpnl.php">Панель услуг</a></li>
                    <li><a href="zakazPanel.php">Панель заказов</a></li>
                    <li><a href="usersi.php">Панель пользователей</a></li>


                <?php }else{ ?>

                <?php } ?>

              <?php }else{ ?>
                <li><a href="zarega.php">Регистрация</a></li>
                <li><a href="whod.php">Вход</a></li>
              <?php } ?>



          </ul>
      </nav>

  </header>



</body>
</html>
