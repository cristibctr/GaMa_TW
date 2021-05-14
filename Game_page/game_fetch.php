<?php
require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
function fetchGame($gameName){
    try{
        $dbh = DBConnect::getConnection();
        $stmt = $dbh->prepare("SELECT * FROM games WHERE name=?");
        $stmt->execute([$gameName]);
        $stmtCategory = $dbh->prepare("SELECT * FROM game_category WHERE name=?");
        $stmtCategory->execute([$gameName]);
        $stmtTarget = $dbh->prepare("SELECT * FROM target_audience WHERE name=?");
        $stmtTarget -> execute([$gameName]);
        return array_merge( $stmt->fetch(PDO::FETCH_ASSOC), 
                            array(
                                'target' => implode(", ", $stmtTarget->fetchAll(PDO::FETCH_COLUMN, 1)), 
                                'category' => implode(", ", $stmtCategory->fetchAll(PDO::FETCH_COLUMN, 1))
                            ), 
                        );
    }
    catch (PDOException $e){
        error_log('PDOException - ' . $e->getMessage(), 0);
        http_response_code(500);
        die('Error establishing connection with database');
    }
}
?>