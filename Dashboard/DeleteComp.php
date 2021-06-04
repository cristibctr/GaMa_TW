<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
    if(isset($_POST['submit']) && $_SESSION['admin']){
        $compName = $_POST['name'];
        try{
            $dbh = DBConnect::getConnection();
            $sth = $dbh->prepare("SELECT name FROM competiti WHERE name=?");
            $sth->execute([$compName]);
            if($sth->rowCount() == 0){
                echo "<script>
                alert('competition not found');
                window.location.href='/Dashboard/Dashboard.php';
                </script>";
                exit();
            }
            $sth = $dbh->prepare("DELETE FROM competiti WHERE name=?");
            $sth->execute([$compName]);
            header("Location: /Dashboard/Dashboard.php");
        }
        catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(500);
            die('Error establishing connection with database');
        }
    }
?>