<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");

function fetchChamp(){
    try{
        $dbh = DBConnect::getConnection();
        if(!empty($_GET['submit'])){
            $query = "SELECT competiti.name, games, first , last, competiti.type, level, cover_image FROM competiti join games on competiti.games=games.name";
            $sth = $dbh->prepare($query);
            
           
        }
       
        $sth->execute();
        
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            echo '
            <div class="format">
                <div class="game1">
                    <div class="space1">
                        <img alt="image" src="../Images/Games_List/' . $row['cover_image'] . '">
                        <div class="games"><p>' . $row['games'] . '</p></div>
                        <div class="name"><p>' . $row['name'] . '</p></div>
                        <div class="level"><p>' . $row['level'] . '</p></div>
                        <div class="type"><p>' . $row['type'] . '</p></div></div>
                    <div class="space2">
                        <div class="start">
                            <p>START</p>
                       <p class="first">' . $row['first'] . '</p></div>
                        <div class="stop">
                            <p>END</p>
                        <p class="last">' . $row['last'] . '</p></div>
                         <div class="link-wrapper">
                           <button type="submit" class="button" name="join">JOIN</button>
                        </div>
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