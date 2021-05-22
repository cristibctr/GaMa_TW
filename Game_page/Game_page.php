<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
    if(isset($_SESSION['username']))
        try{
            $dbh = DBConnect::getConnection();
            $sth = $dbh->prepare("SELECT vote_type FROM user_vote WHERE username=? AND game_name=?");
            $username = $_SESSION['username'];
            $gameName = $_GET['name'];
            $sth->bindParam(1, $username);
            $sth->bindParam(2, $gameName);
            $sth->execute();
            $voteType = 0;
            if($sth->rowCount() > 0)
                $voteType = $sth->fetch(PDO::FETCH_ASSOC)['vote_type'];
        }
        catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(500);
            die('Error establishing connection with database');
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GAMA</title>
        <link rel="shortcut icon" href="../Images/favicon.ico" type ="image/x-icon"/>
        <link rel="stylesheet" href="../Style/siteTemplate.css" type="text/css">
        <link rel="stylesheet" href="../Game_page/Game_page.css" type="text/css">
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
                    <?php
                        if(isset($_SESSION['username']))
                            echo '<li><a href="/Login/logout.php"><span>Logout</span><img alt="navImage" src="/Images/Nav/logout.png"></a></li>';
                        else
                            echo '<li><a href="/Login/login.php"><span>Login</span><img alt="navImage" src="/Images/Nav/login.png"></a></li>';
                    ?>
                </ul>
            </nav>
        </header>
        <?php
            include 'game_fetch.php';
            $gameInfo = fetchGame($_GET['name']);
        ?>
        <div class="main-section">
            <div class="game">
                <div class="button-image-wrapper">
                    <div class="vote-buttons">
                        <form method="POST" action="game_vote.php">
                            <input type="hidden" name="game_name" value="<?php echo $gameInfo['name'];?>">
                            <?php
                            if(isset($_SESSION['username']))
                                if($voteType == 'upvote'){
                                    echo
                                    '<input style="filter: invert(81%) sepia(47%) saturate(531%) hue-rotate(345deg) brightness(95%) contrast(91%);" class="upvote" type="image" name="submit_upvote" value="upvote" alt="upvote" src="/Images/Game_page/up_down_arrow.png">
                                    <input class="downvote" type="image" name="submit_downvote" value="downvote" alt="downvote" src="/Images/Game_page/up_down_arrow.png">';
                                }
                                else if($voteType == 'downvote'){
                                    echo
                                    '<input class="upvote" type="image" name="submit_upvote" value="upvote" alt="upvote" src="/Images/Game_page/up_down_arrow.png">
                                    <input style="filter: invert(81%) sepia(47%) saturate(531%) hue-rotate(345deg) brightness(95%) contrast(91%);" class="downvote" type="image" name="submit_downvote" value="downvote" alt="downvote" src="/Images/Game_page/up_down_arrow.png">';
                                }
                                else{
                                    echo
                                    '<input class="upvote" type="image" name="submit_upvote" value="upvote" alt="upvote" src="/Images/Game_page/up_down_arrow.png">
                                    <input class="downvote" type="image" name="submit_downvote" value="downvote" alt="downvote" src="/Images/Game_page/up_down_arrow.png">';
                                }
                            ?>
                            
                        </form>
                    </div>
                    <div class="photo-wrapper">
                        <img alt="image" class="photo" src ="../Images/Game_page/<?php echo $gameInfo['game_image'];?>">  
                    </div>
                </div>
                <div class="info">
                    <div class="title">
                        <?php echo $gameInfo['name'];?>
                    </div>
                    <div class="basic-info">
                        <ul>
                            <li>Age: <span class="insert-age"><?php echo $gameInfo['age'];?></span></li>
                            <li>Minimum players: <span class="insert-players"><?php echo $gameInfo['players'];?></span></li>
                            <li>Category: <span class="insert-category"><?php echo $gameInfo['category'];?></span></li>
                            <li>Type: <span class="insert-type"><?php echo $gameInfo['type'];?></span></li>
                            <li>Restrictions: <span class="insert-restrictions"><?php echo $gameInfo['restrictions'];?></span></li>
                            <li>Target audience: <span class="insert-audience"><?php echo $gameInfo['target'];?></span></li>
                        </ul>
                    </div>
                    <div class="description">
                        <?php echo $gameInfo['description'];?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(isset($_SESSION['username']) && $_SESSION['admin'] == 1)
        echo    '<a href="/Dashboard/dashboard.php" class="dashboard-button">
                    <img alt="image" src="/Images/Index/speedometer.svg" style="width:70%;" >
                </a>';
        ?>
        <footer>
            <div class="media">
                <a href="../index.php" class="site-name">GAMA</a>
                <div class="social">
                    <a href="https://www.facebook.com"><img alt="image" src="../Images/Index/facebook.png"></a>
                    <a href="https://www.instagram.com"><img alt="image" src="../Images/Index/instagram.png"></a>
                    <a href="https://www.twitter.com"><img alt="image" src="../Images/Index/twitter.png"></a>
                    <a href="https://www.reddit.com"><img alt="image" src="../Images/Index/reddit.png"></a>
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
                <a href="../gameLibrary.html">Game Library</a>
                <a href="../../Join/join.php">Competitions</a>
                <a href="../login.php">Login</a>
            </div>
        </footer>
    </body>
</html>