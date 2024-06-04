<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/mains.css">
    <title>Цирк</title>
</head>
<body>
<div class="navbar">
    <ul>
        <li><button onclick="ChangeTable('logs')">Журнал смен</button></li>
        <li><button onclick="ChangeTable('categories')">Категории артистов</button></li>
        <li><button onclick="ChangeTable('artists')">Артисты</button></li>
        <li><button onclick="ChangeTable('areas')">Список площадок</button></li>
    </ul>
    <a href='../bdrules/PutLog.php' id="LogBtn" class="add-btn"> Добавить</a>
    <a href='../bdrules/PutCategory.php' id="CategoryBtn" class="add-btn"> Добавить</a>
    <a href='../bdrules/PutArtist.php' id="ArtistBtn" class="add-btn"> Добавить</a>
    <a href='../bdrules/PutArea.php' id="AreaBtn" class="add-btn"> Добавить</a>
</div>

<table class="data-table" id="logs">
    <thead>
        <tr>
            <th>Имя актера</th>
            <th>Название шоу</th>
            <th>Дата начала</th>
            <th>Дата окончания</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log) : ?>
        <tr class="item_row">
            <td><?php echo $log['artist_name']; ?></td>
            <td><?php echo $log['show_name']; ?></td>
            <td><?php echo $log['date_beg']; ?></td>
            <td><?php echo $log['date_end']; ?></td>
            <td>
                <form action="" method="post">
                    <button class="edit-btn" name="EditOutputLog" type="submit">Редактировать</button>
                    <button class="delete-btn" name="DeleteOutputLog" type="submit">Удалить</button>
                    <input name="perf_id" value="<?php echo $log['perf_id']; ?>" type="hidden" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table class="data-table" id="categories">
    <thead>
        <tr>
            <th>Название категории</th>
            <th>Жанр</th>
            <th>ЗП</th>
            <th>Описание представления</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody class="table__category">
        <?php foreach ($categories as $category) : ?>
        <tr class="item_row">
            <td><?php echo $category['role_name']; ?></td>
            <td><?php echo $category['genre']; ?></td>
            <td><?php echo $category['salary']; ?></td>
            <td><?php echo $category['performance']; ?></td>
            <td>
                <form action="" method="post">
                    <button class="edit-btn" name="EditCategory" type="submit">Редактировать</button>
                    <button class="delete-btn" name="DeleteCategory" type="submit">Удалить</button>
                    <input name="role_id" value="<?php echo $category['role_id']; ?>" type="hidden" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table class="data-table" id="artists">
    <thead>
        <tr>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Должность</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($artists as $artist) : ?>
        <tr class="item_row">
            <td><?php echo $artist['role_name']; ?></td>
            <td><?php echo $artist['first_name']; ?></td>
            <td><?php echo $artist['last_name']; ?></td>
            <td>
                <form action="" method="post">
                    <button class="edit-btn" name="EditArtist" type="submit">Редактировать</button>
                    <button class="delete-btn" name="DeleteArtist" type="submit">Удалить</button>
                    <input name="artist_id" value="<?php echo $artist['artist_id']; ?>" type="hidden" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table class="data-table" id="Areas">
    <thead>
        <tr>
            <th>Название шоу</th>
            <th>Начало</th>
            <th>Конец</th>
            <th>Город</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Areas as $Area) : ?>
        <tr class="item_row">
            <td><?php echo $Area['name']; ?></td>
            <td><?php echo $Area['setup_date']; ?></td>
            <td><?php echo $Area['close_date']; ?></td>
            <td><?php echo $Area['location']; ?></td>
            <input name="venue_id" value="<?php echo $Area['venue_id']; ?>" type="hidden" />
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    var type = "cirk";
    var OutputlogTable; 
    var CategoriesTable; 
    var ArtistsTable;
    var AresTable;

    var LogsBtn; 
    var CategoriesBtn; 
    var ArtistsBtn;
    var AreasBtn;
    document.addEventListener("DOMContentLoaded", (event) => {
        OutputlogTable = document.getElementById("logs");
        CategoriesTable = document.getElementById("categories");
        ArtistsTable = document.getElementById("artists");
        AresTable = document.getElementById("areas");

        LogsBtn = document.getElementById("LogBtn");
        CategoriesBtn = document.getElementById("CategoryBtn");
        ArtistsBtn = document.getElementById("ArtistBtn");
        AreasBtn = document.getElementById("AreaBtn");
        SetInvisible();
        ChangeTable(type);
    });

    function ChangeTable(t)
    {
        SetInvisible();
        if (t == "logs")
        {
            OutputlogTable.style.display = "block";
            LogsBtn.style.display = "block";
        }   
        else if (t == "categories")
        {
            CategoriesTable.style.display = "block";
            CategoriesBtn.style.display = "block";
        }
        else if (t == "artists")
        {
            ArtistsTable.style.display = "block";
            ArtistsBtn.style.display = "block";
        } 
        else
        {
            AresTable.style.display = "block";
            AreasBtn.style.display = "block";
        }
            
    }

    function SetInvisible()
    {
        OutputlogTable.style.display = "none";
        CategoriesTable.style.display = "none";
        ArtistsTable.style.display = "none";
        AresTable.style.display = "none";

        LogsBtn.style.display = "none";
        CategoriesBtn.style.display = "none";
        ArtistsBtn.style.display = "none";
        AreasBtn.style.display = "none";
    }
</script>
</body>
</html>
