<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");

    if(isset($_POST['upload'])){
        $title = $_POST['title'];
        $cover_image = $_FILES['cover_image']['name'];
        $game_image = $_FILES['game_image']['name'];
        $age = $_POST['age'];
        $year = $_POST['year'];
        $minPlayers = $_POST['minPlayers'];
        $category = $_POST['category'];
        $type = $_POST['type'];
        $restr = $_POST['restr'];
        $tAud = $_POST['tAud'];
        $description = $_POST['description'];
        $target_cover = $_SERVER['DOCUMENT_ROOT'] . "/Images/Games_List/" . basename($cover_image);
        $target_game = $_SERVER['DOCUMENT_ROOT'] . "/Images/Game_page/" . basename($game_image);
        try{
            $dbh = DBConnect::getConnection();
            $sth = $dbh->prepare("SELECT name FROM games WHERE name=?");
            $sth->execute([$title]);
            if($sth->rowCount() > 0){
                header("Location: Add_Game.html");
                exit();
            }
            $query = "INSERT INTO games (name, year, age, players, type, restrictions, description, cover_image, game_image) VALUES (:title, :year, :age, :minPlayers, :type, :restr, :description, :cover_image, :game_image)";
            $sth = $dbh->prepare($query);
            $sth->bindParam(':title', $title);
            $sth->bindParam(':year', $year);
            $sth->bindParam(':age', $age);
            $sth->bindParam(':minPlayers', $minPlayers);
            $sth->bindParam(':type', $type);
            $sth->bindParam(':restr', $restr);
            $sth->bindParam(':description', $description);
            $sth->bindParam(':cover_image', $cover_image);
            $sth->bindParam(':game_image', $game_image);
            $sth->execute();
            move_uploaded_file($_FILES['cover_image']['tmp_name'], $target_cover);
            move_uploaded_file($_FILES['game_image']['tmp_name'], $target_game);
            $query = "INSERT INTO game_category (name, category) VALUES (:title, :category)";
            $sth = $dbh->prepare($query);
            $category = str_replace(", ", ",", $category);
            $categoriesExploded = explode(",", $category);
            foreach($categoriesExploded as $param)
                $sth->execute(array(":title" => $title, ":category" => $param));
            $query = "INSERT INTO target_audience (name, target) VALUES (:title, :tAud)";
            $sth = $dbh->prepare($query);
            $tAud = str_replace(", ", ",", $tAud);
            $tAudExploded = explode(",", $tAud);
            foreach($tAudExploded as $param)
                $sth->execute(array(":title" => $title, ":tAud" => $param));
            header("Location: /Games_Library/Games_List.php");
        }
        catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(500);
            die('Error establishing connection with database');
        }
    }
?>