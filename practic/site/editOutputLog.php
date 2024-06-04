<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Редактировать журнал смен</title>
</head>
<body>
    <div class="container">
        <div class="block">
            <h2>Добавить средство</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="date_beg">Начиная с:</label>
                    <input type="date" id="purchase_date"  value="<?php echo $currentLog['purchase_date']; ?>"name="purchase_date">
                </div>
                <div class="form-group">
                    <label for="date_end">До:</label>
                    <input type="date" id="purchase_date"  value="<?php echo $currentLog['purchase_date']; ?>"name="purchase_date">
                </div>
                <fieldset>
            <legend>Выберите артиста:</legend>
            <?php foreach ($artists as $artist) :?>
            <div>
                <label for="<?php echo $artist["first_name"];?>">
                <input type="radio" name="artist_id" value="<?php echo $artist["artist_id"];?>" />
                <?php echo $artist["first_name"];?>
                </label>
            </div>
            <?php endforeach;?>
            </fieldset>
            <fieldset>
            <legend>Выберите Шоу:</legend>
            <?php foreach ($areas as $area) :?>
            <div>
                <label for="<?php echo $area["name"];?>">
                <input type="radio" name="venue_id" value="<?php echo $area["venue_id"];?>" />
                <?php echo $area["name"];?>
                </label>
            </div>
            <?php endforeach;?>
            </fieldset>
            <input type="text" id="perf_id" value="<?php echo $currentLog["perf_id"];?>" name="perf_id" hidden>
                <input type="submit" value="Редактировать журнал" name="UpdateOutputlogs">
            </form>
        </div>
    </div>
</body>