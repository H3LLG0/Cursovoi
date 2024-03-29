<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="syle.css">
</head>
<body>
<?php
// Подключение к базе данных
define('DB_HOST', 'localhost');
define('DB_NAME', 'jornal');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


// SQL запрос для получения списка уроков
$sql = "SELECT day_of_week FROM lesson";
$result = mysqli_query($link, $sql);
echo"<div class='container'>";
echo "<form method=\"POST\">";
echo "<select name=\"groups\">";
foreach($result as $row){
    $group = $row["day_of_week"];
    echo "<option>
            $group
        </option>";
}
echo "</select>";
echo "<button name=\"proupsButton\">Отправить</button>";
echo "</form>";
$bot = null;
$bot = $_POST["groups"];
if($bot == null)
{
    echo "Выберите день недели";
}
else{
    echo"<p>$bot</p>";
    $sql = "SELECT * FROM lesson where day_of_week='$bot'" ;
    $result = mysqli_query($link, $sql);
    echo '<br><table class="table">';
    echo'<tr><td>1 пара</td><td>2 пара</td><td>3 пара</td><td>4 пара</td></tr>';
    while($row = $result->fetch_array()) {
        echo "<tr><td>".$row['lesson_name']."</td><td>".$row['lesson_name_1']."</td><td>".$row['lesson_name_2']."</td><td>".$row['lesson_name_3']."</td></tr><br>";
    }
    echo '</table>';
    echo "</div>";
}
mysqli_close($link); // Закрываем соединение с базой данных
?>
</body>
</html>