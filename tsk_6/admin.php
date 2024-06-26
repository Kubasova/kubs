<?php

/**
 * Задача 6. Реализовать вход администратора с использованием
 * HTTP-авторизации для просмотра и удаления результатов.
 **/
// Пример HTTP-аутентификации.
// PHP хранит логин и пароль в суперглобальном массиве $_SERVER.
// Подробнее см. стр. 26 и 99 в учебном пособии Веб-программирование и веб-сервисы.

$user = 'u67329';
$pass = '6746979';
$db = new PDO('mysql:host=localhost;dbname=u67329', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  $sth = $db->prepare('SELECT Login, Password FROM Admin');
  $sth->execute();

  $adminLogin;
  $adminPass;
  while ($row = $sth->fetch()) {
    $adminLogin = $row["Login"];
    $adminPass = $row["Password"];
  }
  
//basik
if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != $adminLogin ||
    sha1($_SERVER['PHP_AUTH_PW']) != $adminPass) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}


if (isset($_POST))
{ 
  if(isset($_POST["Delete"])){
    DeleteUser($_POST["Id"]);
    header('Location: ./admin.php');
  } 
  if(isset($_POST["Edit"])){

    setcookie('id', $_POST["Id"], time() + 30 * 24 * 60 * 60);
    setcookie('fio_value', $_POST["Fio"], time() + 30 * 24 * 60 * 60);
    setcookie('tel_value', $_POST["Field-tel"], time() + 30 * 24 * 60 * 60);
    setcookie('email_value', $_POST["Field-email"], time() + 30 * 24 * 60 * 60);
    setcookie('bio_value', $_POST["Bio"], time() + 30 * 24 * 60 * 60);
    setcookie('check_value', $_POST["Check-1"], time() + 30 * 24 * 60 * 60);
    setcookie('gender_value', $_POST["Gender"], time() + 30 * 24 * 60 * 60);
    setcookie('langs_value', $_POST["Favorite-langs"], time() + 30 * 24 * 60 * 60);
    setcookie('date_value', $_POST["Field-date"], time() + 30 * 24 * 60 * 60);

    header('Location: ./editUser.php');
  } 
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  print('Вы успешно авторизовались и видите защищенные паролем данные.');
  $users = GetUsers();
  $result = GetLanguageStats();
  $sum = LanguageSum($result);
  include("adminPage.php");
}
else{
  include("adminPage.php");
}

function GetUsers()
{
  $user = 'u67329';
  $pass = '6746979';
  $db = new PDO('mysql:host=localhost;dbname=u67329', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  try{
      $sth = $db->prepare('SELECT Id, Fio, Phone, Email, FormDate, Gender, Biography, AgreeCheck FROM Forms');
      $sth->execute();
      $k = 0;
      $values = array();
      $row = $sth->fetchAll();
      for($h = 0; $h < count($row); $h++) {
        $values['fio'] = $row[$h]['Fio'];
        $values['field-tel'] = $row[$h]['Phone'];
        $values['field-email'] = $row[$h]['Email'];
        $values['gender'] = $row[$h]['Gender'];
        $values['field-date'] = $row[$h]['FormDate'];
        $values['bio'] = $row[$h]['Biography']; 
        $values['check-1'] = $row[$h]['AgreeCheck'];
        $values['id'] = $row[$h]['Id'];
        $formId = $row[$h]['Id'];
        $sth = $db->prepare('SELECT LanguageId FROM FormLanguages WHERE FormId = :id');
        $sth->execute(['id' => $formId]);
        $j = 0;
        $langs = [];
        $rowlang = $sth->fetchAll();
        for($i = 0; $i < count($rowlang); $i++) {
          $sth = $db->prepare('SELECT LanguageName FROM Languages WHERE Id = :id');
          $sth->execute(['id' => ($rowlang[$i])['LanguageId']]);
          while ($langrow = $sth->fetch()) {
            $langs[$j++] = $langrow['LanguageName'];
          }
        }
        $langsValue = '';
        for($i = 0; $i < count($langs); $i++)
        {
          $langsValue .= $langs[$i] . ",";
        }
        $values['favorite-langs'] = $langsValue;
        $users[$k++] = $values;
      }
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    print_r($e->getTrace());
    exit();
  }
  

  return $users;
}

function DeleteUser($id)
{
  $user = 'u67329';
  $pass = '6746979';
  $db = new PDO('mysql:host=localhost;dbname=u67329', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  try{
    $sth = $db->prepare('DELETE FROM Users WHERE FormId = :id');
    $sth->execute(['id' => $id]);
    $sth = $db->prepare('DELETE FROM FormLanguages WHERE FormId = :id');
    $sth->execute(['id' => $id]);
    $sth = $db->prepare('DELETE FROM Forms WHERE Id = :id');
    $sth->execute(['id' => $id]);
  }
  catch(PDOException $e){
    print_r($e->getTrace());
    exit();
  }
}

function GetLanguageStats()
{
  $user = 'u67329';
  $pass = '6746979';
  $db = new PDO('mysql:host=localhost;dbname=u67329', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  try{
    $sth = $db->prepare('SELECT LanguageName, COUNT(*) AS LanguageCount FROM FormLanguages JOIN Languages ON FormLanguages.LanguageId = Languages.Id GROUP BY LanguageName ORDER BY LanguageCount DESC');
    $sth->execute();
    $result = array();
    while ($row = $sth->fetch()) {
      $result[$row["LanguageName"]]= $row['LanguageCount'];
    }
  }
  catch(PDOException $e){
    print_r($e->getTrace());
    exit();
  }

  return $result;
}

function LanguageSum($arr)
{
  $sum = 0;
  foreach($arr as $count)
  {
    $sum += $count;
  }
  return $sum;
}
?>
