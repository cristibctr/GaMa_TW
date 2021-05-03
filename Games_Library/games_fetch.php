<?php
function fetchGames(){
    try{
        $dbh = new PDO('mysql:host=localhost;dbname=gama_tw', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $dbh->prepare("SELECT name, year, age, cover_image FROM games");
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