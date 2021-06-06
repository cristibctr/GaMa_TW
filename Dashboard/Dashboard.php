<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
    try{
        $dbh = DBConnect::getConnection();
        //fetch games
        $games = $dbh->prepare("SELECT name FROM games");
        $games->execute();
        //fetch users
        $users = $dbh->prepare("SELECT username FROM users");
        $users->execute();
        //fetch competitions
        $competitions = $dbh->prepare("SELECT * FROM competiti");
        $competitions->execute();
        //user participation
        $participation = $dbh->prepare("SELECT nume, comp FROM numecomp");
        $participation->execute();
        $userComp = $participation->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);
        //competitions participants
        $participation = $dbh->prepare("SELECT nume, comp FROM numecomp");
        $participation->execute();
        $compParticipants = $participation->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP, 1);
    } 
    catch (PDOException $e){
        error_log('PDOException - ' . $e->getMessage(), 0);
        http_response_code(500);
        die('Error establishing connection with database');
    }
    session_start();
    if(!isset($_SESSION['username']) || $_SESSION['admin'] == 0){
        header("location: /index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GAMA</title>
        <link rel="shortcut icon" href="../Images/favicon.ico" type ="image/x-icon"/>
        <link rel="stylesheet" href="../Style/siteTemplate.css" type="text/css">
        <link rel="stylesheet" href="Dashboard.css" type="text/css">
        <link rel="preconnect" href="https://fonts.gstatic.com"> 
    </head>
    <body>
        <header>
            <div class="site-name">
                <h1><a href="../index.php">GaMa</a></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="/index.php"><span>Home</span><img alt="navImage" src="/Images/Nav/home.png"></a></li>
                    <li><a href="/Games_Library/Games_List.php"><span>Game Library</span><img alt="navImage" src="/Images/Nav/library.png"></a></li>
                    <li><a href="/Join/join.php"><span>Competitions</span><img alt="navImage" src="/Images/Nav/competition.png"></a></li>
                    <li><a href="/Login/logout.php"><span>Logout</span><img alt="navImage" src="/Images/Nav/logout.png"></a></li>
                </ul>
            </nav>
        </header>
        <h1>STATISTICS</h1>
        <div class="statistics">
            <form method="get" action="StatsDownload.php">
                <select id="format" name="format">
                    <option value="pdf" selected>PDF</option>
                    <option value="csv">CSV</option>
                </select>
                <button type="submit">DOWNLOAD</button>
             </form>             
        </div>
        <h1>DASHBOARD</h1>
        <div class="dashboard">
            <div class="users">
                <h1>USERS</h1>
                <div class="cards-wrapper">
                    <?php
                        while($row = $users->fetch(PDO::FETCH_ASSOC)){
                            echo    '<div class="card">
                                        <div class="username">'.$row['username'].'</div>
                                        <div class="participation">
                                            <h3>Championships</h3>';
                            if(array_key_exists($row['username'], $userComp))
                                foreach($userComp[$row['username']] as $uc){
                                    echo '<p class="champ-particip">'.$uc.'</p>';
                                }
                            else
                                echo '<p class="champ-particip">NONE</p>';
                            echo '</div>
                                    <form method="POST" action="DeleteUser.php">
                                        <input type="hidden" name="username" value="'.$row['username'].'">
                                        <input type="submit" name="submit" value="DELETE" class="delete">
                                    </form>
                                </div>';
                        }
                    ?>
                </div>
            </div>
            <div class="competitions">
                <h1>COMPETITIONS</h1>
                <div class="cards-wrapper">
                    <?php
                        while($row = $competitions->fetch(PDO::FETCH_ASSOC)){
                            echo '<div class="card-wrapper">
                                    <div class="no-overflow card">
                                        <div class="competition">'.$row['name'].'</div>
                                        <div class="game">
                                            <h3>Game:</h3>
                                            <p class="game-name">'.$row['games'].'</p>
                                        </div>
                                        <form method="POST" action="DeleteComp.php">
                                            <input type="hidden" name="name" value="'.$row['name'].'">
                                            <input type="submit" name="submit" value="DELETE" class="delete">
                                        </form>
                                        <div class="show-more" onclick="showInfo(this)">Show more ▼</div>
                                    </div>
                                    <div class="more-info" style="display: none">
                                        <p>Starting date: <span>'.$row['first'].'</span></p>
                                        <p>Ending date: <span>'.$row['last'].'</span></p>
                                        <p>Participants:</p>
                                        <ul>';
                            if(array_key_exists($row['name'], $compParticipants))
                                foreach($compParticipants[$row['name']] as $cp){
                                    echo    '<li>'.$cp.'</li>';
                                }
                            else
                                echo        '<li>NONE</li>';                
                            echo        '</ul>
                                    </div>
                                </div>';
                        }
                    ?>
                </div>
            </div>
            <div class="games">
                <h1>GAMES</h1>
                <div class="cards-wrapper">
                    <?php
                        while($row = $games->fetch(PDO::FETCH_ASSOC)){
                            echo    '<div class="card">
                                        <div class="game-name">'.$row['name'].'</div>
                                        <form method="POST" action="DeleteGame.php">
                                            <input type="hidden" name="name" value="'.$row['name'].'">
                                            <input type="submit" name="submit" value="DELETE" class="delete">
                                        </form>
                                    </div>';
                        }
                    ?>
                </div>
            </div>
        </div>
            
        <script>
            function showInfo(moreInfo){
                var parent = moreInfo.parentElement.parentElement;
                var parentMoreInfo = parent.getElementsByTagName('div')[4];
                var firstDiv = parent.getElementsByTagName('div')[0];
                if(parentMoreInfo.style.display == 'none')
                {
                    parentMoreInfo.style.display = 'flex';
                    firstDiv.style.borderRadius = '10px 10px 0px 0px';
                    moreInfo.innerHTML = 'Show less ▲';
                }
                else
                {
                    parentMoreInfo.style.display = 'none';
                    firstDiv.style.borderRadius = '10px';
                    moreInfo.innerHTML = 'Show more ▼';
                }
            }
        </script>
        <footer>
            <div class="media">
                <a href="../index.php" class="site-name">GAMA</a>
                <div class="social">
                    <a href="https://www.facebook.com"><img alt="image" src="/Images/Index/facebook.png"></a>
                    <a href="/Documentatie/scholarly-html-GaMa-report/index.html"><img alt="image" src="/Images/Index/document.png"></a>
                    <a href="/RSS/rss.php"><img alt="image" src="/Images/Index/rss-feed.png"></a>
                    <a href="https://www.reddit.com"><img alt="image" src="/Images/Index/reddit.png"></a>
                </div>
            </div>
            <div class="contact">
                <h2>Contact</h2>
                <p class="name">Bucataru Cristian-Stefan</p>
                <p class="email">cristian.bucataru@gmail.com</p>
                <p class="name">Florea Robert-Marian</p>
                <p class="email">ciric122@gmail.com</p>
            </div>
            <div class="site-map">
                <h2>Site map</h2>
                <a href="../index.php">Home</a>
                <a href="../Games_Library/Games_List.php">Game Library</a>
                <a href="../Join/join.php">Competitions</a>
                <?php
                if(!isset($_SESSION['username']))
                    echo '<a href="/Login/login.php">Login</a>';
                else
                    echo '<a href="/Login/logout.php">Logout</a>';
                ?>
            </div>
        </footer>
    </body>
</html>