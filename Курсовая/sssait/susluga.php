
<?php
session_start();

?>
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
       display: flex;
       flex-direction: column;
       min-height: 100vh;
   }

 header {
       background-color: var(--primary-color);
       color: white;
       padding: 1rem 0;
       text-align: center;
   }

   main {
       flex: 1;
       max-width: 1400px;
       margin: 20px auto;
       padding: 20px;
       background-color: white;
       border-radius: 8px;
       box-shadow: 0 2px 10px var(--shadow-color);
   }

   .site-footer {
       text-align: center;
       padding: 1rem 0;
       background-color: var(--primary-color);
       color: white;
   }

   .service-container {
      width: 800px;
       display: flex;
       flex-direction: column;
       gap: 20px;
       background-color: #f9f9f9;
       border-radius: 8px;
       padding: 20px;
   }
   .service-header {
       display: flex;
       align-items: flex-start;
   }

   .service-image-container {
      width: 400px;
       height: 400px;
        margin-right: 30px;
       overflow: hidden;
    }

    .service-image {
        width: 100%;
       height: 100%;
        object-fit: cover;
       border-radius: 8px;
    }
    .prikol-text-container {
         display: flex;
         justify-content: center;
      }

     .prikol-text {
           padding: 10px 20px;
           text-align: center;
           background-color: var(--primary-color);
           color: white;
          border-radius: 5px;
          cursor: pointer;
          user-select: none;

          display: inline-block;
      }
     .prikol-text:hover {
          background-color: #367c39;
    }

      .modal {
          display: none;
          position: fixed;
          z-index: 1;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
         overflow: auto;
          background-color: rgba(0, 0, 0, 0.4);
      }

      .modal-content {
          background-color: white;
         margin: 15% auto;
         padding: 20px;
          border: 1px solid #888;
          width: 80%;
          max-width: 600px;
          border-radius: 8px;
          position: relative;
      }

      .close-button {
         color: #aaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
          cursor: pointer;
     }
     .close-button:hover,
     .close-button:focus {
         color: black;
          text-decoration: none;
        cursor: pointer;
    }

    .service-details {
        display: flex;
        flex-direction: column;
        flex: 1;
        margin-left: 100px;
    }

    .service-details h1,
    .service-details .service-price {
        margin: 0;
    }

    .service-details h1 {
       margin-bottom: 20px;
    }
    .service-description {
       text-align: left;
        margin-top: 1rem;
   }
   @media (max-width: 768px) {
       .service-header {
             flex-direction: column;
       }
       .service-image-container {
            width: 100%;
           margin-right: 0px;
           height: auto;

      }
   }
</style>

<?php
$conn = mysqli_connect("localhost", "root", "", "salon");

if (isset($_GET['id'])) {
    $usluga_id = $_GET['id'];
    $sql = "SELECT * FROM uslugi WHERE id_uslugi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usluga_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <title><?php echo htmlspecialchars($row['name']); ?></title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <header>
                <?php include 'header.php'; ?>
            </header>
            <main>
                <div class="service-container">
                    <div class="service-header">
                         <div class="service-image-container">
                            <img class="service-image" src="foto/<?php echo htmlspecialchars($row['foto']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        </div>
                         <div class="service-details">
                            <h1><?php echo htmlspecialchars($row['name']); ?></h1>
                            <p class="service-price">Цена: <?php echo htmlspecialchars($row['price']); ?></p>
                        </div>
                   </div>
                  <div class="service-description">
                     <p><?php echo htmlspecialchars($row['opisanie']); ?></p>
                   </div>
                    <div class="prikol-text-container">
                      <div class="prikol-text" id="openDialogButton">
                        <span>записаться</span>
                      </div>
                    </div>

                    
                    <div id="myDialog" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                              <form id="bookingForm" action="zapis.php" method="post">
                                <input type="hidden" name="serviceName" value="<?php echo htmlspecialchars($row['name']); ?>"
                                    <label for="bookingDate">Выберите дату:</label>
                                    <input type="date" id="bookingDate" name="bookingDate" required><br><br>
                                    <label for="bookingTime">Выберите время:</label>
                                    <input type="time" id="bookingTime" name="bookingTime" required><br><br>
                                   <button type="submit" name="book_service">Записаться</button>
                              </form>


                        </div>
                    </div>
                </div>
            </main>
            <?php include 'footer.php'; ?>
            <script>
    const openDialogButton = document.getElementById('openDialogButton');
    const myDialog = document.getElementById('myDialog');
    const closeButton = document.querySelector('.close-button');


    openDialogButton.addEventListener('click', () => {
        myDialog.style.display = 'block';
    });


    closeButton.addEventListener('click', () => {
        myDialog.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === myDialog) {
           myDialog.style.display = 'none';
        }
    });

    </script>
        </body>
        </html>
        <?php
    } else {
        echo "Услуга не найдена.";
    }
$conn->close();
} else {
    echo "Не указан ID услуги.";
}
?>
