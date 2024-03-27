<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" />
  <title>Task_3</title>
</head>

<body>

  <div class="form-container">
    <form action="index.php" method="POST">
      <label>
        ФИО:
        <br/>
        <input name="fio" type="name" value="Иванов Иван Иванович">
      </label>
      <br>
      <label>
        Телефон:<br>
        <input name="field-tel" type="tel" placeholder="Введите ваш телефон" >
      </label><br>
      <label>
        Email:<br>
        <input name="field-email" type="email" placeholder="Введите вашу почту">
      </label><br>
      <label>
        Введите дату рождения:<br>
        <input name="field-date" value="2003-10-13" type="date">
      </label><br>
      Выберете ваш пол:<br>
      <label><input type="radio" checked="checked" name="gender" value="Male">
        Мужчина</label>
      <label><input type="radio" name="gender" value="Female">
        Женщина</label><br>
      <br>
      <label>
        Выберете ваши любимые языки программирования:
        <br>
        <select name="favorite-langs[]" multiple>
          <option value="Pascal">Pascal</option>
          <option value="JavaScript">JavaScript</option>
          <option value="PHP">PHP</option>
          <option value="Python">Python</option>
          <option value="Haskel">Haskel</option>
          <option value="Clojure">Clojure</option>
          <option value="Prolog">Prolog</option>
          <option value="Scala">Scala</option>
        </select>
        <br>
      </label><br>
      <label>
        Ваша биография:<br>
        <textarea name="bio" cols="90" rows="10">Давным-давно, в далекой-далекой галактике... </textarea>
      </label><br>
      <br>
      <label><input type="checkbox" class="checkbox" name="check-1">
        с контрактом ознакомлен(а)</label><br>
      <br>
      <input class="button" type="submit" value="Сохранить">
    </form>
  </div>
</body>

</html>
