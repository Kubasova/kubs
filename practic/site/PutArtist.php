<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Добавить актера</title>
</head>
<body>
    <div class="container">
        <div class="block">
            <h2>Добавить актера</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="first_name">Имя:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Фамилия:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <fieldset>
                <legend>Выберите роль:</legend>
                <?php foreach ($artists as $art) :?>
                <div>
                    <label for="<?php echo $art["role_name"];?>">
                    <input type="radio" name="role_id" value="<?php echo $art["role_id"];?>" />
                    <?php echo $art["role_name"];?>
                    </label>
                    </div>
                <?php endforeach;?>
                </fieldset>
                <input type="submit" value="Добавить" name="PutArtist">
            </form>
        </div>
    </div>
</body>