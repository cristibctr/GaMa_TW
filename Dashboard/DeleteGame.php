<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
    if(isset($_POST['submit'])){
        $gameName = $_POST['name'];
        try{
            $dbh = DBConnect::getConnection();
            $sth = $dbh->prepare("SELECT name FROM games WHERE name=?");
            $sth->execute([$gameName]);
            if($sth->rowCount() == 0){
                echo "<script>
                alert('Game not found');
                window.location.href='/Dashboard/Dashboard.php';
                </script>";
                exit();
            }
            $sth = $dbh->prepare("DELETE FROM games WHERE name=?");
            $sth->execute([$gameName]);
            header("Location: /Dashboard/Dashboard.php");
        }
        catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(500);
            die('Error establishing connection with database');
        }
    }
?>