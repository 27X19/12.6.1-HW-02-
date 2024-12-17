<?php 
    require "function.php";
    $getData = getGenderDescription($example_persons_array);
    $women = $getData['women'];
    $men = $getData['men'];
    $undefined = $getData['undefined'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Задание Тимур || Админ панель</title>
</head>
<body>
    <nav>
        <a href="index.php">Назад</a>
    </nav>
    <div class="panelAdmin">
        <div class="blockAdmin">
            <span>Гендерный состав аудитории: </span>
            <div class="items">
                <p>Мужчины - <?=$men?>% </p>
                <p>Женщины - <?=$women?>% </p>
                <p>Не удалось определить - <?=$undefined?>% </p>
            </div>
        </div>
    </div>
</body>
</html>

