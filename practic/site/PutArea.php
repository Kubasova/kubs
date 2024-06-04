<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Добавить шоу</title>
</head>
<body>
    <div class="container">
        <div class="block">
            <h2>Добавить новое представление</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">Название шоу:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="setup_date">Дата начала:</label>
                    <input type="date" id="setup_date" name="setup_date">
                </div>
                <div class="form-group">
                    <label for="close_date">Дата окончания:</label>
                    <input type="date" id="close_date" name="close_date">
                </div>
                <div class="form-group">
                    <label for="location">Город:</label>
                    <input type="text" id="location" name="location" required>
                </div>
                <input type="submit" value="Добавить" name="PutArea">
            </form>
        </div>
    </div>
</body>