<?php 
    include("../database/database.php");
    $user = 'u67329'; 
    $pass = '6746979'; 
    $db = new PDO('mysql:host=localhost;dbname=u67329', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $type = "cirk";
        $logs = GetOutputLogs($db);
        $artists = GetArtists($db);
        $categories = GetArtistCategories($db);
        $areas = GetListAreas($db);
        include("../site/main.php");
      }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST["DeleteOutputLog"])){
            DeleteOutputLog($db, $_POST["perf_id"]);
            header('Location: ./mainData.php');
          } 

        if(isset($_POST["DeleteArtist"])){
            DeleteArtist($db, $_POST["artist_id"]);
            header('Location: ./mainData.php');
          } 

        if(isset($_POST["DeleteCategory"])){
            DeleteArtistCategory($db, $_POST["role_id"]);
            header('Location: ./mainData.php');
          } 
          
        if(isset($_POST["EditOutputLog"])){
            $currentLog = array();
            $artists = GetArtists($db);
            $categories = GetArtistCategories($db);
            $currentLog = GetOutputLogById($db, $_POST["asset_id"]);
            include('../site/editOutputLog.php');
          } 

        if(isset($_POST["EditArtist"])){
            $currentArtist = array();
            $currentArtist = GetArtistById($db, $_POST["artist_id"]);
            include('../site/editArtist.php');
          } 

        if(isset($_POST["EditCategory"])){
            $currentCategory = array();
            $currentCategory = GetArtistCategoryById($db, $_POST["role_id"]);
            include('../site/editCategory.php');
          } 

          if(isset($_POST["UpdateOutputlogs"])){
            UpdateOutputLog($db, $_POST["perf_id"], $_POST["artist_id"], $_POST["venue_id"], $_POST["date_beg"], $_POST["date_end"]);
            header('Location: ./mainData.php');
            exit();
          } 

          if(isset($_POST["UpdateArtist"])){
            UpdateArtist($db, $_POST["artist_id"],  $_POST["role_id"], $_POST["first_name"], $_POST["last_name"]);
            header('Location: ./mainData.php');
            exit();
          } 

          if(isset($_POST["UpdateCategory"])){
            UpdateArtistCategory($db, $_POST["role_id"],  $_POST["role_name"], $_POST["genre"], $_POST["performance"]);
            header('Location: ./mainData.php');
            exit();
          }           
    }
?>