<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Добавить роль</title>
</head>
<body>
    <div class="container">
        <div class="block">
            <h2>Добавить роль</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="role_name">Название:</label>
                    <input type="text" id="role_name" name="role_name" required>
                </div>
                <div class="form-group">
                    <label for="genre">Жанр:</label>
                    <input type="text" id="genre" name="genre" required>
                </div>
                <div class="form-group">
                    <label for="salary">ЗП:</label>
                    <input type="number" id="salary" name="salary" step="100.00" required>
                </div>
                <div class="form-group">
                    <label for="performance">Описание:</label>
                    <textarea id="performance" name="performance" required></textarea>
                </div>
                <input type="submit" value="Добавить" name="PutCategory">
            </form>
        </div>
    </div>
</body>
