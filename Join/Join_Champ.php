<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
    if(isset($_POST['join']) && isset($_SESSION['username'])){
        $nume = $_SESSION['username'];
        $comp = $_POST['compName'];
            try{
                $dbh = DBConnect::getConnection();
                $sth = $dbh->prepare("SELECT * from numecomp WHERE nume=? AND comp=?");
                $sth->bindParam(1, $nume);
                $sth->bindParam(2, $comp);
                $sth->execute();
                if($sth->rowCount() > 0)
                {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
                $sth = $dbh->prepare("INSERT INTO numecomp (nume, comp) VALUES (?, ?)");
                $sth->bindParam(1, $nume);
                $sth->bindParam(2, $comp);
                $sth->execute();
            }
            catch(PDOException $e){
                error_log('PDOException - ' . $e->getMessage(), 0);
                http_response_code(500);
                die('Error establishing connection with database'.$e);
            }
        }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>