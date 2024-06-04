<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Редактировать артиста</title>
</head>
<body>
    <div class="container">
        <div class="block">
            <h2>Изменить актера</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="first_name">Имя:</label>
                    <input type="text" id="first_name" value="<?php echo $currentArtist['first_name']; ?>" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Фамилия:</label>
                    <input type="text" id="last_name" value="<?php echo $currentArtist['last_name']; ?>" name="last_name" required>
                </div>
                <fieldset>
                <legend>Выберите роль:</legend>
                <?php foreach ($categories as $category) :?>
                <div>
                    <label for="<?php echo $category["role_name"];?>">
                    <input type="radio" name="role_id" value="<?php echo $category["role_id"];?>" />
                    <?php echo $category["role_name"];?>
                    </label>
                </div>
                <?php endforeach;?>
                </fieldset>
                <input type="text" id="artist_id" value="<?php echo $currentArtist["artist_id"];?>" name="artist_id" hidden>
                <input type="submit" value="Изменить" name="UpdateArtist">
            </form>
        </div>
    </div>
</body>
