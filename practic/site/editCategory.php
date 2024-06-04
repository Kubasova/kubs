<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Редактировать роль</title>
</head>
<body>
    <div class="container">
        <div class="block">
            <h2>Добавить категорию</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="role_name">Название роли:</label>
                    <input type="text" id="role_name" value="<?php echo $currentCategory["role_name"];?>" name="role_name" required>
                </div>
                <div class="form-group">
                    <label for="genre">Жанр:</label>
                    <input type="text" id="genre" value="<?php echo $currentCategory["genre"];?>" name="genre" required>
                </div>
                <div class="form-group">
                    <label for="salary">ЗП:</label>
                    <input type="text" id="salary" value="<?php echo $currentCategory['salary']; ?>" name="salary" step="100.00" required>
                </div>
                <div class="form-group">
                    <label for="performance">Описание представления:</label>
                    <textarea id="performance" name="performance" required><?php echo $currentCategory["performance"];?></textarea>
                </div>
                <input type="text" id="role_id" value="<?php echo $currentCategory["role_id"];?>" name="role_id" hidden>
                <input type="submit" value="Редактировать роль" name="UpdateCategory">
            </form>
        </div>
    </div>
</body>
