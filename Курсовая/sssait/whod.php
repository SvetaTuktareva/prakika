<!DOCTYPE html>
<html lang="en">
<style >
body {
          font-family: Arial, sans-serif;
          background-color: #f0f0f0;
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
          margin: 0;
      }
      form {
          background-color: white;
          height: 300px;
          width:   auto;
          padding: 20px;
          border-radius: 8px;
          box-shadow: 0 2px 10px rgba(0,0,0,0.1);
          display: inline-grid;
          gap: 10px;
      }
      h1 {
          color: black;
          margin-bottom: 10px;
          text-align: center;
      }
      input[type="text"],
      input[type="password"] {
          width: 300px;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 4px;
          font-size: 14px;
      }
      input[type="submit"] {
          width: 100%;
          padding: 10px;
          background-color: blue;
          color: white;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          font-size: 16px; 
          text-align: center;
      }
      input[type="submit"]:hover
</style>
<head>
<meta charset="utf-8">
  <title>вход\регистрация</title>
</head>
<body>
<form style="display: inline-grid;" action="vhood.php" method="post">
  <a href="main.php">вернулься на главную</a>
  АВТОРИЗАЦИЯ<br>
  <br>
  Логин: <input name="login" type="text">
  Пароль: <input name="password" type="password">
  <input type="submit">
</form>

</body>
</html>
