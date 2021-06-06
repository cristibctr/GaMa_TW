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
        <link rel="shortcut icon" href="../Images/favicon.ico" type ="image/x-icon"/>
         <link rel="stylesheet" href="styleCreate.css">
        <link rel="stylesheet" href="../Style/siteTemplate.css" type="text/css">
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
           
   
    <div class="base">
        <div class="sec1">
            <form method="post" action="CREATE.php" enctype="multipart/form-data">
                <div class="create">
                        <h1>CREATE CHAMPIONSHIP</h1> </div>
                <div class="games">
                    <p>GAMES</p>
                     <div class="drop">
                         

                           <select name="games" class="cars">
                           <?php
                           require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
                           $dbh = DBConnect::getConnection();
                             $sth = $dbh->prepare("SELECT name FROM games");
                                $sth->execute();
                              $dbname=$sth->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_ASSOC, 0) ;
                                foreach($dbname as $names){
                                    echo '<option value="'.$names.'">'.$names.'</option>';
                                }

                           ?>

                        
                           </select>
                          </div>
                         
                </div>


           
            
                <div class="level">
                    <p>LEVEL</p>
                     <div class="drop">
                          

                           <select class="cars" name="level">
                                <option value="begginer">BEGGINER</option>
                                <option value="inter">INTERMEDIAR</option>
                                <option value="hard">HARD-CORE</option>
                                <option value="insane">INSANE</option>
                               
                           </select>
                            
                          </div>
                         
                </div>


           
           
                <div class="type">
                    <p>GAME MODE</p>
                     <div class="drop" >
                            
                           
                         

                           <select name="type" class="cars" >
                                <option value="single">SINGLE-PLAYER</option>
                                <option value="multi">MULTI-PLAYER</option>
                               
                           </select>
                          </div>
                        
                </div>


            
                         <div class="first">
                            <label for="first">FIRST DAY</label>
                            <input type="date" name="first" id="first">   
                        </div>
                        <div class="last">
                             <label for="last">LAST DAY</label>
                             <input type="date" name="last" id="last">   
                        </div>
                        <div class="name">
                            <label for="name">NAME</label>
                            <input type="text" name="name" id="name">
                        </div>
                        
                        <div class="sec2">
                            <button type="submit" class="submit" name="go">GO!</button></div>
                        
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