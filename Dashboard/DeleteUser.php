<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
    if($_POST['submit'] == 'DELETE' && $_SESSION['admin']){
        $userName = $_POST['username'];
        try{
            $dbh = DBConnect::getConnection();
            $sth = $dbh->prepare("SELECT username FROM users WHERE username=?");
            $sth->execute([$userName]);
            if($sth->rowCount() == 0){
                echo "<script>
                alert('User not found');
                window.location.href='/Dashboard/Dashboard.php';
                </script>";
                exit();
            }
            $sth = $dbh->prepare("DELETE FROM users WHERE username=?");
            $sth->execute([$userName]);
            header("Location: /Dashboard/Dashboard.php");
        }
        catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(500);
            die('Error establishing connection with database');
        }
    }
?>