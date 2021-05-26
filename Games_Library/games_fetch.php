<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");


    try{
        $dbh = DBConnect::getConnection();
        if(!empty($_GET['submit'])){
            $query = "SELECT DISTINCT a.name, a.year, a.age, a.cover_image FROM (SELECT name, year, age, cover_image, category FROM games NATURAL JOIN game_category";
                $query = $query . " WHERE name LIKE ? AND age LIKE ? AND year LIKE ?";
            if(!empty($_GET['category'])){
                $query = $query . " AND (";
                foreach($_GET['category'] as $key => $category){
                    $query = $query . "category LIKE ?";
                    if(!($key === array_key_last($_GET['category'])))
                        $query = $query . " OR ";
                }
                $query = $query . ")) a";
            }
            else{
                $query = $query . ") a";
            }

            $sth = $dbh->prepare($query);
            $name = '%'.$_GET['search'].'%';
            $age = $_GET['age'];
            $year = $_GET['release-year'].'%';
            $sth -> bindParam(1, $name);
            $sth -> bindParam(2, $age);
            $sth -> bindParam(3, $year);
            if(!empty($_GET['category'])){
                foreach($_GET['category'] as $key => &$category){
                    $sth -> bindParam($key+4, $category);
                }
            }
        }
        else{
            $sth = $dbh->prepare("SELECT name, year, age, cover_image FROM games");
        }
        $sth->execute();
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        header("content-type:application/json");
        echo json_encode($rows);
    }
    catch (PDOException $e){
        error_log('PDOException - ' . $e->getMessage(), 0);
        http_response_code(500);
        die('Error establishing connection with database');
    }

?>