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
            <form>
                <div class="create">
                        <h1>CREATE CHAMPIONSHIP</h1> </div>
                <div class="games">
                    <p>GAMES</p>
                     <div class="drop">
                         

                           <select name="games" class="cars">
                                <option value="dota2">DOTA 2</option>
                                <option value="dota2">CYBERPUNK</option>
                                <option value="dota2">HALF-LIFE</option>
                                <option value="dota2">CATAN</option>
                                <option value="dota2">CONNECT-FOUR</option>
                                <option value="dota2">MONOPOLY</option>
                                <option value="dota2">SCRABBLE</option>
                                <option value="dota2">CS-GO</option>
                           </select>
                          </div>
                         
                </div>


           
            
                <div class="level">
                    <p>LEVEL</p>
                     <div class="drop">
                          

                           <select name="games" class="cars">
                                <option value="dota2">BEGGINER</option>
                                <option value="dota2">INTERMEDIAR</option>
                                <option value="dota2">HARD-CORE</option>
                                <option value="dota2">INSANE</option>
                               
                           </select>
                            
                          </div>
                         
                </div>


           
           
                <div class="mode">
                    <p>GAME MODE</p>
                     <div class="drop" >
                            
                           
                         

                           <select name="games" class="cars">
                                <option value="dota2">SINGLE-PLAYER</option>
                                <option value="dota2">MULTI-PLAYER</option>
                               
                           </select>
                          </div>
                        
                </div>


            
                         <div class="first">
                            <label for="date">FIRST DAY</label>
                            <input type="date" name="date" id="date">   
                        </div>
                        <div class="second">
                             <label for="dateL">LAST DAY</label>
                             <input type="date" name="dateL" id="dateL">   
                        </div>
                        <div class="name">
                            <label for="name1">NAME</label>
                            <input type="text" name="name1" id="name1">
                        </div>
            </form>
         </div>
   
        <div class="sec2">
            <button type="submit" class="submit">GO!</button>
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
                <a href="../Games_Library/Games_List.php">Game Library</a>
                <a href="../Join/join.php">Competitions</a>
                <a href="../Login/login.php">Login</a>
            </div>
        </footer>
</body>