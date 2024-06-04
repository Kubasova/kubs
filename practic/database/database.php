<?php

function SaveArtistCategory($db)
{
    try {
        $stmt = $db->prepare("INSERT INTO artist_categories (role_name, genre, salary, performance) VALUES (:role_name, :genre, :salary, :performance)");
        $stmt->execute([
            'role_name' => $_POST["role_name"], 
            'genre' => $_POST["genre"], 
            'salary'=>$_POST["salary"],
            'performance'=>$_POST["performance"]
        ]);
    } catch (PDOException $e) {
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
    }
}

function SaveArtist($db)
{
    try {
        $stmt = $db->prepare("INSERT INTO artists (role_id, first_name, last_name) VALUES (:role_id, :first_name, :last_name)");
        $stmt->execute([
            'role_id' => $_POST["role_id"], 
            'first_name' => $_POST["first_name"], 
            'last_name' => $_POST["last_name"]
        ]);
    } catch (PDOException $e) {
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
    }
}

function SaveOutputLog($db)
{
    try {
        $stmt = $db->prepare("INSERT INTO performances (artist_id, venue_id, date_beg, date_end) VALUES (:artist_id, :venue_id, :date_beg, :date_end)");
        $stmt->execute([
            'artist_id' => $_POST["artist_id"],
            'venue_id' => $_POST["venue_id"],
            'date_beg' => $_POST["date_beg"],
            'date_end' => $_POST["date_end"]
        ]);
    } catch (PDOException $e) {
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
    }
}

function SaveListArea($db)
{
    try {
        $stmt = $db->prepare("INSERT INTO venues (name, setup_date, close_date, location) VALUES (:name, :setup_date, :close_date, :location)");
        $stmt->execute([
            'name' => $_POST["name"],
            'setup_date' => $_POST["setup_date"],
            'close_date' => $_POST["close_date"],
            'location' => $_POST["location"]
        ]);
    } catch (PDOException $e) {
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
    }
}

function GetOutputLogs($db)
{
    try {
        $sth = $db->prepare('SELECT * FROM performances p Join artists a on a.artist_id = p.artist_id Join venues v on v.venue_id = p.venue_id');
        $logs = array();
        $result = $sth->execute();
        $row = $sth->fetchAll();
        foreach ($row as $r) {
            $result = array();
            $result['perf_id'] = $r['perf_id'];
            $result['artist_id'] = $r['artist_id'];
            $result['venue_id'] = $r['venue_id'];
            $result['date_beg'] = $r['date_beg'];
            $result['date_end'] = $r['date_end'];
            $result['artist_name'] = $r['first_name'];
            $result['show_name'] = $r['name'];
            $logs[] = $result;
        }
    } catch (PDOException $e) {
        print_r($e->getTrace());
        exit();
    }
    return $logs;
}

function GetArtistCategories($db)
{
    try {
        $sth = $db->prepare('SELECT * FROM artist_categories');
        $categories = array();
        $result = $sth->execute();
        $row = $sth->fetchAll();
        foreach ($row as $r) {
            $result = array();
            $result['role_id'] = $r['role_id'];
            $result['role_name'] = $r['role_name'];
            $result['genre'] = $r['genre'];
            $result['salary'] = $r['salary'];
            $result['performance'] = $r['performance'];
            $categories[] = $result;
        }
    } catch (PDOException $e) {
        print_r($e->getTrace());
        exit();
    }
    return $categories;
}

function GetArtists($db)
{
    try {
        $sth = $db->prepare('SELECT * FROM artists a join artist_categories c on c.role_id=a.role_id');
        $artists = array();
        $result = $sth->execute();
        $row = $sth->fetchAll();
        foreach ($row as $r) {
            $result = array();
            $result['artist_id'] = $r['artist_id'];
            $result['role_id'] = $r['role_id'];
            $result['first_name'] = $r['first_name'];
            $result['last_name'] = $r['last_name'];
            $result['role_name'] = $r['role_name'];
            $artists[] = $result;
        }
    } catch (PDOException $e) {
        print_r($e->getTrace());
        exit();
    }
    return $artists;
}

function GetListAreas($db)
{
    try {
        $sth = $db->prepare('SELECT * FROM venues');
        $areas = array();
        $result = $sth->execute();
        $row = $sth->fetchAll();
        foreach ($row as $r) {
            $result = array();
            $result['venue_id'] = $r['venue_id'];
            $result['name'] = $r['name'];
            $result['setup_date'] = $r['setup_date'];
            $result['close_date'] = $r['close_date'];
            $result['location'] = $r['location'];
            $areas[] = $result;
        }
    } catch (PDOException $e) {
        print_r($e->getTrace());
        exit();
    }
    return $areas;
}

function DeleteOutputLog($db, $id)
{
    try {
        $sth = $db->prepare('DELETE FROM performances WHERE perf_id = :id');
        $sth->execute(['id' => $id]);
    } catch (PDOException $e) {
        print_r($e->getTrace());
        exit();
    }
}

function DeleteArtistCategory($db, $id)
{
    try {
        $sth = $db->prepare('SELECT perf_id FROM performances p JOIN artists a WHERE a.role_id = :id');
        $sth->execute(['id' => $id]);
        $perf_id = ($sth->fetch())["perf_id"];
        $sth = $db->prepare('DELETE FROM performances WHERE perf_id = :id');
        $sth->execute(['id' => $perf_id]);
        $sth = $db->prepare('DELETE FROM artists WHERE role_id = :id');
        $sth->execute(['id' => $id]);
        $sth = $db->prepare('DELETE FROM artist_categories WHERE role_id = :id');
        $sth->execute(['id' => $id]);
    } catch (PDOException $e) {
        print_r($e->getTrace());
        exit();
    }
}

function DeleteArtist($db, $id)
{
    try {
        $sth = $db->prepare('DELETE FROM performances WHERE artist_id = :id');
        $sth->execute(['id' => $id]);
        $sth = $db->prepare('DELETE FROM artists WHERE artist_id = :id');
        $sth->execute(['id' => $id]);
    } catch (PDOException $e) {
        print_r($e->getTrace());
        exit();
    }
}

function GetOutputLogById($db, $id)
{
    $result = array();
    $sth = $db->prepare('SELECT * FROM performances WHERE perf_id = :id');
    $sth->execute(["id" => $id]);
    while ($row = $sth->fetch()) {
        $result['perf_id'] = $row['perf_id'];
        $result['artist_id'] = $row['artist_id'];
        $result['venue_id'] = $row['venue_id'];
        $result['date_beg'] = $row['date_beg'];
        $result['date_end'] = $row['date_end'];
    }
    return $result;
}

function GetArtistCategoryById($db, $id)
{
    $result = array();
    $sth = $db->prepare('SELECT * FROM artist_categories WHERE role_id = :id');
    $sth->execute(["id" => $id]);
    while ($row = $sth->fetch()) {
        $result['role_id'] = $row['role_id'];
        $result['role_name'] = $row['role_name'];
        $result['genre'] = $row['genre'];
        $result['salary'] = $row['salary'];
        $result['performance'] = $row['performance'];
    }
    return $result;
}

function GetArtistById($db, $id)
{
    $result = array();
    $sth = $db->prepare('SELECT * FROM artists WHERE artist_id = :id');
    $sth->execute(["id" => $id]);
    while ($row = $sth->fetch()) {
        $result['artist_id'] = $row['artist_id'];
        $result['role_id'] = $row['role_id'];
        $result['first_name'] = $row['first_name'];
        $result['last_name'] = $row['last_name'];
    }
    return $result;
}

function UpdateOutputLog($db, $id, $artist_id, $venue_id, $date_beg, $date_end)
{
    $stmt = $db->prepare("UPDATE performances SET artist_id = :artist_id, venue_id = :venue_id, date_beg = :date_beg, date_end = :date_end WHERE perf_id = :id");
    $stmt->execute([
        'artist_id' => $artist_id,
        'venue_id' => $venue_id,
        'date_beg' => $date_beg,
        'date_end' => $date_end,
        'id' => $id
    ]);
}

function UpdateArtistCategory($db, $id, $role_name, $genre, $salary, $performance)
{
    $stmt = $db->prepare("UPDATE artist_categories SET role_name = :role_name, genre = :genre, salary = :salary, performance = :performance WHERE role_id = :id");
    $stmt->execute([
        'role_name' => $role_name,
        'genre' => $genre,
        'salary' => $salary,
        'performance' => $performance,
        'id' => $id
    ]);
}

function UpdateArtist($db, $id, $role_id, $first_name, $last_name)
{
    $stmt = $db->prepare("UPDATE artists SET role_id = :role_id, first_name = :first_name, last_name = :last_name WHERE artist_id = :id");
    $stmt->execute([
        'role_id' => $role_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'id' => $id
    ]);
}
?>
