<html>
<html lang="ru">
<head>
    <title>Таблица умножения</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th>*</th>
        <?php
        for ($i = 0; $i <= 10; $i++) {
            echo "<th>$i</th>";
        }
        ?>
    </tr>
    <?php
    for ($i = 0; $i <= 10; $i++) {
        echo "<tr>";
        echo "<th>$i</th>";
        for ($j = 0; $j <= 10; $j++) {
            echo "<td>" . ($i * $j) . "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
