<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <games>GAMA</games>
       
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
         <div class="link-create">
                            <a href="../Create/ccreate.php">
                                <div class="button-create"><p>CREATE YOURSELF</p></div>
                                
                            </a>
                           
                             <div class="text-create">If you don't like others</div>
       </div>
    <div class="gamespage">YOUR COMPETITIONS</div>
       <div class="gameself">
           <div class="format">
             <?php
                    if(isset($_SESSION['username'])){
                       if(isset($_POST['join'])){
                                     $username = $_POST['username'];
                                        $yourcomp=$_POST['yourcomp'];
        try{
            $dbh = DBConnect::getConnection();
            $sth = $dbh->prepare("SELECT numecomp FROM numecomp where numecomp = ?");
            $sth->execute([$username]);
            if($sth->rowCount() > 0){
               header("Location:/Join/join.php");
               
                exit();
            }
            $query = "INSERT INTO competiti (username, numecomp) VALUES (:username, :numecomp)";
            $sth = $dbh->prepare($query);
            $sth->bindParam(':username', $username);
            $sth->bindParam(':numecomp', $numecomp);
            
          
            $sth->execute();
            
            header("Location:/Join/join.php");
        }
        catch(PDOException $e){
            echo('PDOException - ' . $e->getMessage());
            http_response_code(500);
            die('Error establishing connection with database');
        }
    }
                    }


                    fetchChamp();
                    
                   
                ?>
                <div class="game1">
                    <div class="space1">
                        <img alt="image" src="../Images/Games_List/Monopoly.jpg">
                        <div class="games"><p>MONOPOLY</p></div>
                        <div class="name"><p>HYDRA</p></div>
                        <div class="level"><p>HARD-CORE</p></div>
                        <div class="type"><p>MULTI-PLAYER</p></div></div>
                    <div class="space2">
                        <div class="start">
                            <p>START</p>
                       <p class="first">29/01/2021</p></div>
                        <div class="stop">
                            <p>END</p>
                        <p class="last">31/02/2021</p></div>
                         <div class="link-wrapper">
                            <a href="../Game_page/Monopoly/Game_Monopoly.html">
                                <div class="button"><p>JOINED</p></div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="format">
                <div class="game6">
                     <div class="space1">
                        <img alt="image" src="../Images/Games_List/Dota2.jpg">
                        <div class="games"><p>DOTA 2</p></div>
                        <div class="name"><p>MAGE</p></div>
                        <div class="level"><p>INSANE</p></div>
                        <div class="type"><p>MULTI-PLAYER</p></div></div>
                     <div class="space2">
                        <div class="start">
                            <p>START</p>
                       <p class="first">22/08/2021</p></div>
                        <div class="stop">
                            <p>END</p>
                        <p class="last">11/10/2021</p></div>
                         <div class="link-wrapper">
                            <a href="../Game_page/Dota2/Game_Dota2.html">
                                <div class="button"><p>JOINED</p></div>
                            </a>
                        </div>
                    </div>
                </div>
             </div>
              <div class="format">
                <div class="game4">
                    <div class="space1">
                          <img alt="image" src="../Images/Games_List/cyberpunk.jpeg">
                        <div class="games"><p>CYBERPUNK</p></div>
                        <div class="name"><p>TENNOR</p></div>
                        <div class="level"><p>INTERMEDIAR</p></div>
                        <div class="type"><p>SINGLE-PLAYER</p></div></div>
                    <div class="space2">
                        <div class="start">
                            <p>START</p>
                       <p class="first">17/03/2021</p></div>
                        <div class="stop">
                            <p>END</p>
                        <p class="last">21/08/2021</p></div>
                         <div class="link-wrapper">
                            <a href="../Game_page/Cyberpunk/Game_Cyberpunk.html">
                                <div class="button"><p>JOINED</p></div>
                            </a>
                        </div>
                    </div>

                </div>
             </div>
       </div>



        <div class="gamespage">OTHER COMPETITIONS</div>
        <div class="gamebody">
        <?php
            require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
            fetchChamp();                    
           ?>
            <div class="format">
                <div class="game1">
                    <div class="space1">
                        <img alt="image" src="../Images/Games_List/Monopoly.jpg">
                        <div class="games"><p>MONOPOLY</p></div>
                        <div class="name"><p>HYDRA</p></div>
                        <div class="level"><p>HARD-CORE</p></div>
                        <div class="type"><p>MULTI-PLAYER</p></div></div>
                    <div class="space2">
                        <div class="start">
                            <p>START</p>
                       <p class="first">29/01/2021</p></div>
                        <div class="stop">
                            <p>END</p>
                        <p class="last">28/02/2021</p></div>
                         <div class="link-wrapper">
                            <a href="../Game_page/Monopoly/Game_Monopoly.html">
                                <div class="button"><p>JOIN</p></div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
             <div class="format">
                <div class="game2">
                  <img alt="image" src="../Images/Games_List/csgo.jpg">
                    <div class="space1">
                        
                        
                        <div class="games"><p>CS-GO</p></div>
                        <div class="name"><p>AVATAR</p></div>
                        <div class="level"><p>INSANE</p></div>
                        <div class="type"><p>MULTI-PLAYER</p></div>
                    </div>
                    <div class="space2">

                        <div class="start">
                            <p>START</p>
                       <p class="first">14/05/2021</p></div>
                        <div class="stop">
                            <p>END</p>
                        <p class="last">21/07/2021</p></div>
                         <div class="link-wrapper">
                            <a href="../Game_page/CSGO/Game_CSGO.html">
                                <div class="button"><p>JOIN</p></div>
                            </a>
                        </div>
                    </div>

                </div>
             </div>
             <div class="format">
                <div class="game3">
                    <div class="space1">
                        <img alt="image" src="../Images/Games_List/Catan-2015-boxart.jpg">
                        <div class="games"><p>CATAN</p></div>
                        <div class="name"><p>BRAWL</p></div>
                        <div class="level"><p>BEGGINNER</p></div>
                        <div class="type"><p>MULTI-PLAYER</p></div></div>
                    <div class="space2">
                        <div class="start">
                            <p>START</p>
                       <p class="first">19/11/2021</p></div>
                        <div class="stop">
                            <p>END</p>
                        <p class="last">17/12/2021</p></div>
                         <div class="link-wrapper">
                           <a href="../Game_page/Catan/Game_Catan.html">
                                <div class="button"><p>JOIN</p></div>
                            </a>
                        </div>
                    </div>

                 </div>
            </div>
             <div class="format">
                <div class="game4">
                    <div class="space1">
                          <img alt="image" src="../Images/Games_List/cyberpunk.jpeg">
                        <div class="games"><p>CYBERPUNK</p></div>
                        <div class="name"><p>TENNOR</p></div>
                        <div class="level"><p>INTERMEDIAR</p></div>
                        <div class="type"><p>SINGLE-PLAYER</p></div></div>
                    <div class="space2">
                        <div class="start">
                            <p>START</p>
                       <p class="first">17/03/2021</p></div>
                        <div class="stop">
                            <p>END</p>
                        <p class="last">21/08/2021</p></div>
                         <div class="link-wrapper">
                            <a href="../Game_page/Cyberpunk/Game_Cyberpunk.html">
                                <div class="button"><p>JOIN</p></div>
                            </a>
                        </div>
                    </div>

                </div>
             </div>
             <div class="format">
                <div class="game5">
                    <div class="space1">
                        <img alt="image" src="../Images/Games_List/connect-four.jpg">
                        <div class="games"><p>CONNECT-FOUR</p></div>
                        <div class="name"><p>COPS</p></div>
                        <div class="level"><p>HARD-CORE</p></div>
                        <div class="type"><p>MULTI-PLAYER</p></div></div>
                    <div class="space2">
                        <div class="start">
                            <p>START</p>
                       <p class="first">19/05/2021</p></div>
                        <div class="stop">
                            <p>END</p>
                        <p class="last">25/06/2021</p></div>
                         <div class="link-wrapper">
                            <a href="../Game_page/Connect_Four/Game_Connect_Four.html">
                                <div class="button"><p>JOIN</p></div>
                            </a>
                        </div>
                    </div>

            </div></div>
             <div class="format">
                <div class="game6">
                     <div class="space1">
                        <img alt="image" src="../Images/Games_List/Dota2.jpg">
                        <div class="games"><p>DOTA 2</p></div>
                        <div class="name"><p>MAGE</p></div>
                        <div class="level"><p>INSANE</p></div>
                        <div class="type"><p>MULTI-PLAYER</p></div></div>
                     <div class="space2">
                        <div class="start">
                            <p>START</p>
                       <p class="first">22/08/2021</p></div>
                        <div class="stop">
                            <p>END</p>
                        <p class="last">11/10/2021</p></div>
                         <div class="link-wrapper">
                            <a href="../Game_page/Dota2/Game_Dota2.html">
                                <div class="button"><p>JOIN</p></div>
                            </a>
                        </div>
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
                <a href="../Games_Library/Games_List.php">Game Library</a>
                <a href="join.php">Competitions</a>
                <a href="../Login/login.php">Login</a>
            </div>
        </footer>
    </body>
</html>