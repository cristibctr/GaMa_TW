<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GAMA</title>
       
        <link rel="shortcut icon" href="favicon.ico" type ="image/x-icon"/>
        <link rel="stylesheet" href="../Style/siteTemplate.css" type="text/css">
        <link rel="preconnect" href="https://fonts.gstatic.com"> 
        <link rel="stylesheet" href="join.css">
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
                    <li><a href="/Join/join.php" style="color: rgb(232, 192, 97)"><span>Competitions</span><img alt="navImage" src="/Images/Nav/competition.png"></a></li>
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
             <?php
                require_once($_SERVER['DOCUMENT_ROOT']."/Join/championships.php");
                    if(isset($_SESSION['username'])){
                        echo '<div class="link-create">
                        <a href="../Create/ccreate.php">
                            <div class="button-create"><p>CREATE YOURSELF</p></div>
                            
                        </a>
                       
                         <div class="text-create">If you don&#39t like others</div>
   </div>
                        <div class="titlepage">YOUR COMPETITIONS</div>
                                <div class="gameself">';
                        $username = $_SESSION['username'];
                        try{
                            $dbh = DBConnect::getConnection();
                            $sth = $dbh->prepare("SELECT comp, games, first, last, level, type FROM numecomp JOIN competiti ON numecomp.comp = competiti.name where nume = ?");
                            $sth->execute([$username]);
                            while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                                echo '<div class="format borderFormat">
                                        <div class="game6">
                                            <div class="space1">
                                                <div class="name"><p>' . $row['games'] . '</p></div>
                                                <div class="name"><p>' . $row['comp'] . '</p></div>
                                                <div class="level"><p>' . $row['level'] . '</p></div>
                                                <div class="type"><p>' . $row['type'] . '</p></div></div>
                                            <div class="space2">
                                                <div class="start">
                                                    <p>START</p>
                                            <p class="first">' . $row['first'] . '</p></div>
                                                <div class="stop">
                                                    <p>END</p>
                                                <p class="last">' . $row['last'] . '</p></div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                            echo '</div>';
                        }
                        catch(PDOException $e){
                            echo('PDOException - ' . $e->getMessage());
                            http_response_code(500);
                            die('Error establishing connection with database');
                        }
                    }
                    
                   
                ?>



        <div class="titlepage">OTHER COMPETITIONS</div>
        <div class="gamebody">
        <?php
            require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
            fetchChamp();                    
           ?>
            
             
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
                <a href="join.php">Competitions</a>
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