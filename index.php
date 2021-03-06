<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GAMA</title>
        <link rel="shortcut icon" href="Images/favicon.ico" type ="image/x-icon"/>
        <link rel="stylesheet" href="Style/siteTemplate.css" type="text/css">
        <link rel="stylesheet" href="Style/indexStyle.css" type="text/css">
        <link rel="preconnect" href="https://fonts.gstatic.com"> 
    </head>
    <body>
        <header>
            <div class="site-name">
                <h1><a href="/index.php">GaMa</a></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="/index.php" style="color: rgb(232, 192, 97)"><span>Home</span><img alt="navImage" src="/Images/Nav/home.png"></a></li>
                    <li><a href="/Games_Library/Games_List.php"><span>Game Library</span><img alt="navImage" src="/Images/Nav/library.png"></a></li>
                    <li><a href="/Join/join.php"><span>Competitions</span><img alt="navImage" src="/Images/Nav/competition.png"></a></li>
                    <?php
                        session_start();
                        if(isset($_SESSION['username']))
                            echo '<li><a href="/Login/logout.php"><span>Logout</span><img alt="navImage" src="/Images/Nav/logout.png"></a></li>';
                        else
                            echo '<li><a href="/Login/login.php"><span>Login</span><img alt="navImage" src="/Images/Nav/login.png"></a></li>';
                    ?>
                </ul>
            </nav>
        </header>
        <div class="intro">
            <div class="title">
                <h1>Find The Games You Want To Play.</h1>
            </div>
            <div class="subtitle">
                <p>Biggest Game Library At Your Fingertips</p>
            </div>
            <div class="button">
                <a href="Games_Library/Games_List.php">
                    <div class="browse">
                        <p>Browse Now</p>
                    </div>
                </a>
                <div class="link-image">
                    <a href="Games_Library/Games_List.php"><img alt="image" src="Images/Index/1536784688.svg"></a>
                </div>
            </div>
        </div>
        <div class="second-panel">
            <div class="text-area">
                <div class="text">
                    <h1>Tabletop<br/>Games</h1>
                    <svg>
                        <path d="M0 0 H300 V8 H170 L150 30 L130 8 H0 z"/>
                    </svg>
                    <p>Learn to play a variety of board games, card games and Pen and paper RPG's. Let the nostalgia take you back to your childhood.</p>
                </div>
            </div>
        </div>
        <div class="third-panel">
            <div class="text-area">
                <div class="text">
                    <h1>Video<br/>Games</h1>
                    <svg>
                        <path d="M0 0 H300 V8 H170 L150 30 L130 8 H0 z"/>
                    </svg>
                    <p>The games of today are made to fit everyone's personality. We've collected all the information there is out there so you don't have to. Find the one that fits you best and start Gaming.</p>
                </div>
            </div>
        </div>
        <div class="competition-panel">
            <div class="compete">
                <div class="wrapper">
                    <div class="image">
                        <img alt="image" src="Images/Index/Compete.jpeg">
                    </div>
                    <div class="text">
                        <h1>Compete</h1>
                        <span>Start competing today and win prizes.</span>
                    </div>
                </div>
            </div>
            <div class="create">
                <div class="wrapper">
                    <div class="image">
                        <img alt="image" src="Images/Index/indexCompetition.jpg">
                    </div>
                    <div class="text">
                        <h1>Create</h1>
                        <span>Create your competition and meet new people.</span>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(isset($_SESSION['username']) && $_SESSION['admin'] == 1)
        echo    '<a href="Dashboard/dashboard.php" class="dashboard-button">
                    <img alt="image" src="Images/Index/speedometer.svg" style="width:70%;" >
                </a>';
        ?>
        <footer>
            <div class="media">
                <a href="index.php" class="site-name">GAMA</a>
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
                <a href="index.php">Home</a>
                <a href="Games_Library/Games_List.php">Game Library</a>
                <a href="Join/join.php">Competitions</a>
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