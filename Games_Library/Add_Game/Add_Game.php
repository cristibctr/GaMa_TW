<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: /index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GAMA</title>
        <link rel="shortcut icon" href="/Images/favicon.ico" type ="image/x-icon"/>
        <link rel="stylesheet" href="/Style/siteTemplate.css" type="text/css">
        <link rel="stylesheet" href="Add_Game.css" type="text/css">
        <link rel="preconnect" href="https://fonts.gstatic.com"> 
    </head>
    <body>
        <header>
            <div class="site-name">
                <h1><a href="/index.php">GaMa</a></h1>
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
        <div class="main-section">
            <div class="game">
                <form method="post" action="addGame.php" enctype="multipart/form-data">
                    <div class="photo-wrapper">
                        <label for="cover_image">Choose an image for the game card</label>
                        <input type="file" name="cover_image" id="cover_image" accept="image/*">
                        <label for="game_image">Choose an image for the game page</label>
                        <input type="file" name="game_image" id="game_image" accept="image/*">
                    </div>
                    <div class="info">
                        <div class="title">
                            <input type="text" placeholder="Title" name="title" required>
                        </div>
                        <div class="basic-info">
                            <ul>
                                <li><label for="age">Age:</label> <input type="text" name="age" id="age" required></li>
                                <li><label for="year">Release year:</label> <input type="text" name="year" id="year" required></li>
                                <li><label for="minPlayers">Minimum players:</label> <input type="text" name="minPlayers" id="minPlayers" required></li>
                                <li><label for="category">Category:</label> <input type="text" name="category" id="category" required></li>
                                <li class="type"> 
                                    <p>Type:</p> 
                                    <input type="radio" name="type" id="Board-Game" value="Board-Game" required> <label for="Board-Game">Board-Game</label>
                                    <input type="radio" name="type" id="Video-Game" value="Video-Game"> <label for="Video-Game">Video-Game</label>
                                </li>
                                <li><label for="restr">Restrictions:</label> <input type="text" name="restr" id="restr" required></li>
                                <li><label for="tAud">Target audience:</label> <input type="text" name="tAud" id="tAud" required></li>
                            </ul>
                        </div>
                        <div class="description">
                            <textarea placeholder="Description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" value="Submit" name="upload">
                    </div>
                </form>
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
                <a href="/index.php" class="site-name">GAMA</a>
                <div class="social">
                    <a href="https://www.facebook.com"><img alt="image" src="/Images/Index/facebook.png"></a>
                    <a href="https://www.instagram.com"><img alt="image" src="/Images/Index/instagram.png"></a>
                    <a href="https://www.twitter.com"><img alt="image" src="/Images/Index/twitter.png"></a>
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
                <a href="/index.php">Home</a>
                <a href="/Games_Library/Games_List.php">Game Library</a>
                <a href="/Join/join.php">Competitions</a>
                <a href="/Login/login.php">Login</a>
            </div>
        </footer>
    </body>
</html>