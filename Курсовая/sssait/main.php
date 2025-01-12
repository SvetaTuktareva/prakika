<?php
session_start();
include('db.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Салон красоты</title>
    <style>
    :root {
          --primary-color: #4CAF50;
          --secondary-color: #007BFF;
          --light-grey: #f4f4f4;
          --shadow-color: rgba(0, 0, 0, 0.2);
      }
      body {
          margin: 0;
          font-family: Arial, sans-serif;
          background-color: var(--light-grey);
      }
      header {
        background-color: var(--primary-color);
        color: white;
        padding: 1rem 0;
        text-align: center;
      }
      .promo-section {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 20px;
          margin: 20px auto;
          max-width: 1400px;
      }

      .promo-text {
          flex: 1;
          padding-right: 20px;
      }
      .prikol-text {
          flex: 1;
          padding-right: 20px;
          text-align: center;
      }

       .promo-image {
          max-width: 300px;
          height: auto;
          border-radius: 8px;
      }


      .products {
          display: flex;
          flex-wrap: wrap;
          justify-content: center;
          max-width: 1400px;
          margin: 20px auto;
          background: white;
          padding: 20px;
          border-radius: 8px;
          box-shadow: 0 2px 10px var(--shadow-color);
      }
      .news {
          margin: 1rem;
          border: 1px solid #ddd;
          border-radius: 8px;
          padding: 1rem;
          background-color: #fff;
          transition: box-shadow 0.2s;
          box-sizing: border-box;
          text-align: center; 
          align-items: center;
          cursor: pointer;
          width: calc(50% - 2rem);
          display: flex;
          flex-direction: column;
          justify-content: center;
      }

      .news:hover {
          box-shadow: 0 4px 20px var(--shadow-color);
      }
      .news img {
          width: 300px;
          height: 200px;
          border-radius: 8px;
          display: block;
          margin: 10 auto 1rem;
      }


      .news-content {
          flex: 1;
          display: flex;
          flex-direction: column;
          align-items: center;
          text-align: center;
      }
      .news h2, .news h1, .news p {
          margin: 0.2rem 0;
      }
      @media (max-width: 768px) {
          .news {
              width: calc(100% - 2rem);
          }
          .promo-section {
              flex-direction: column;
              text-align: center;
          }
          .promo-image {
              margin-top: 1rem;
              max-width: 100%;
          }
          .news img {
              width: 80px;
          }
      }
      @media (min-width: 1200px) {
          .news {
              width: calc(25% - 2rem);
          }
      }

    .full-width-banner {
       width: 100%;
       display: block;
   }

    .banner-image {
       width: 100%;
      height: auto;
     display: block;
    }
    </style>
</head>
<body>
  <header>
      <?php include 'header.php';
       ?>
  </header>
  <div class="banner">
         <img src="foto/yyy.jpg" alt="Баннер" class="banner-image">
      </div>
    <div class="promo-section">
        <div class="promo-text">
            <h1>Лучший салон красоты</h1>
            <p>Салон красоты "Элегант" — это идеальное место для тех, кто хочет насладиться атмосферой уюта и расслабления, получая профессиональные услуги по уходу за собой. Мы предлагаем широкий спектр процедур, которые помогут вам выглядеть и чувствовать себя великолепно. </p>
        </div>
       <img class="promo-image" src="foto/rrr.jpg" alt="Салон красоты">
    </div>

    <div class="prikol-text">
        <h1>Наши новые услуги</h1>
        <p>Полный список услуг вы можете посмотреть во вкладке "Каталог". </p>
    </div>



    <div class="products">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "salon");
        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM uslugi ORDER BY id_uslugi DESC LIMIT 4";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<a href='susluga.php?id=" . $row['id_uslugi'] . "' class='news'>";
                echo "<img src='foto/" . $row['foto'] . "' alt='" . htmlspecialchars($row['name']) . "'>";
                echo "<div class='news-content'>";
                echo "<h2>" . $row['name'] . "</h2>";
                echo "</div>";
                echo "</a>";
            }
        } else {
            echo "Нет товаров.";
        }
        $conn->close();
        ?>
  </div>
</body>
<?php include 'footer.php';
 ?>
</html>
