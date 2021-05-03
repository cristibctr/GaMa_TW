<?php
    if(isset($_POST['upload'])){
        $title = $_POST['title'];
        $image = $_FILES['image']['name'];
        $age = $_POST['age'];
        $year = $_POST['year'];
        $minPlayers = $_POST['minPlayers'];
        $category = $_POST['category'];
        $type = $_POST['type'];
        $restr = $_POST['restr'];
        $tAud = $_POST['tAud'];
        $description = $_POST['description'];
        $target = "images/".basename($image);
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=gama_tw', 'root', '');
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sth = $dbh->prepare("SELECT name FROM games WHERE name=?");
            $sth->execute([$title]);
            if($sth->rowCount() > 0){
                header("Location: Add_Game.html");
                exit();
            }
            $query = "INSERT INTO games (name, year, age, players, type, restrictions, description, image) VALUES (:title, :year, :age, :minPlayers, :type, :restr, :description, :image)";
            $sth = $dbh->prepare($query);
            $sth->bindParam(':title', $title);
            $sth->bindParam(':year', $year);
            $sth->bindParam(':age', $age);
            $sth->bindParam(':minPlayers', $minPlayers);
            $sth->bindParam(':type', $type);
            $sth->bindParam(':restr', $restr);
            $sth->bindParam(':description', $description);
            $sth->bindParam(':image', $image);
            $sth->execute();
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            }else{
                $msg = "Failed to upload image";
            }
            $query = "INSERT INTO game_category (name, category) VALUES (:title, :category)";
            $sth = $dbh->prepare($query);
            $category = str_replace(" ", "", $category);
            $categoriesExploded = explode(",", $category);
            foreach($categoriesExploded as $param)
                $sth->execute(array(":title" => $title, ":category" => $param));
            $query = "INSERT INTO target_audience (name, target) VALUES (:title, :tAud)";
            $sth = $dbh->prepare($query);
            $tAud = str_replace(" ", "", $tAud);
            $tAudExploded = explode(",", $tAud);
            foreach($tAudExploded as $param)
                $sth->execute(array(":title" => $title, ":tAud" => $param));
            header("Location: /Games_Library/Games_List.html");
        }
        catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(500);
            die('Error establishing connection with database');
        }
    }
?>