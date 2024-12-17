<?php 
    require "function.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Задание Тимур</title>
</head>
<body>
    <nav>
        <a href="admin.php">Админ панель</a>
    </nav>
    <div class="panel">
        <div class="block">
            <?php 
                getPerfectPartner($surname, $name, $patronymic, $example_persons_array);
            ?>
        </div>
    </div>
</body>
</html>

