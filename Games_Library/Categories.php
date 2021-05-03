<?php
function fetchCategories(){
    try{
        $dbh = new PDO('mysql:host=localhost;dbname=gama_tw', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $dbh->prepare("SELECT DISTINCT category FROM game_category");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_ASSOC, 0);
    }
    catch (PDOException $e){
        error_log('PDOException - ' . $e->getMessage(), 0);
        http_response_code(500);
        die('Error establishing connection with database');
    }
}
?>