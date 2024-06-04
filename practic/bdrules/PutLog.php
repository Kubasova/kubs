<?php 

    include("../database/database.php");
    $user = 'u67329'; 
    $pass = '6746979'; 
    $db = new PDO('mysql:host=localhost;dbname=u67329', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $artists = array();
        $artists = GetArtists($db);
        $areas = array();
        $areas = GetListAreas($db);
        include("../site/PutLog.php");
      }
      
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST["PutLog"])){

          SaveAsset($db);
          header('Location: ./mainData.php');
          exit();
        }
      }
?>
