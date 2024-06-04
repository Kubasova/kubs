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
                    <legend>Выберите шоу:</legend>
                    <?php foreach ($areas as $area) :?>
                        <div>
                            <label for="<?php echo $area["name"];?>">
                            <input type="radio" name="venue_id" value="<?php echo $area["venue_id"];?>" />
                            <?php echo $area["name"];?>
                            </label>
                        </div>
                    <?php endforeach;?>
                </fieldset>
                <div class="form-group">
                    <label for="date_beg">Начиная с:</label>
                    <input type="date" id="date_beg" name="date_beg">
                </div>
                <div class="form-group">
                    <label for="date_end">До:</label>
                    <input type="date" id="date_end" name="date_end">
                </div>
                <input type="text" id="perf_id" value="<?php echo $currentLog["perf_id"];?>" name="perf_id" hidden>
                <input type="submit" value="Редактировать журнал" name="UpdateOutputlogs">
            </form>
        </div>
    </div>
</body>
