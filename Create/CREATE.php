<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");

    if(isset($_POST['go'])){
        $name = $_POST['name'];
        $games=$_POST['games'];
        $first = $_POST['first'];
        $last = $_POST['last'];
        $level = $_POST['level'];
        $type = $_POST['type'];
       
        
    
        try{
            $dbh = DBConnect::getConnection();
            $sth = $dbh->prepare("SELECT name FROM competiti where name = ?");
            $sth->execute([$name]);
            if($sth->rowCount() > 0){
               header("Location:/Join/join.php");
               
                exit();
            }
            $query = "INSERT INTO competiti (name, games, first, last, level, type) VALUES (:name, :games, :first, :last, :level, :type)";
            $sth = $dbh->prepare($query);
            $sth->bindParam(':name', $name);
            $sth->bindParam(':games', $games);
            $sth->bindParam(':first', $first);
            $sth->bindParam(':last', $last);
            $sth->bindParam(':level', $level);
            $sth->bindParam(':type', $type);
          
            $sth->execute();
            
            header("Location:/Join/join.php");
        }
        catch(PDOException $e){
            echo('PDOException - ' . $e->getMessage());
            http_response_code(500);
            die('Error establishing connection with database');
        }
    }
?>