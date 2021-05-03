<?php
function fetchGames(){
    try{
        $dbh = new PDO('mysql:host=localhost;dbname=gama_tw', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT DISTINCT a.name, a.year, a.age, a.cover_image FROM (SELECT name, year, age, cover_image, category FROM games NATURAL JOIN game_category";
        if(!empty($_GET['submit'])){
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
        }

        $sth = $dbh->prepare($query);
        if(!empty($_GET['submit'])){
            $name = $_GET['search'].'%';
            $age = $_GET['age'].'%';
            $year = $_GET['release-year'].'%';
            $sth -> bindParam(1, $name);
            $sth -> bindParam(2, $age);
            $sth -> bindParam(3, $year);
            foreach($_GET['category'] as $key => &$category){
                $sth -> bindParam($key+4, $category);
            }
        }
        $sth->execute();
        
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            echo '
            <div class="game-wrapper">
                <div class="game1">
                    <img alt="image" src="../Images/Games_List/' . $row['cover_image'] . '">
                    <div class="gamecard-title"><p>' . $row['name'] . '</p></div>
                    <div class="gamecard-release">
                        <p>Release year</p>
                        <p class="release-year">' . $row['year'] . '</p>
                    </div>
                    <div class="gamecard-age">
                        <p>Age</p>
                        <p class="age">' . $row['age'] . '+</p>
                    </div>
                    <div class="link-wrapper">
                        <a href="../Game_page/Game_page.php?name=' . $row['name'] . '">
                            <div class="button"><p>Details</p></div>
                        </a>
                    </div>
                </div>
            </div>';
        }
    }
    catch (PDOException $e){
        error_log('PDOException - ' . $e->getMessage(), 0);
        http_response_code(500);
        die('Error establishing connection with database');
    }
}
?>