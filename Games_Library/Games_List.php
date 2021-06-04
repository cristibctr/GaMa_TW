<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GAMA</title>
        <link rel="shortcut icon" href="../Images/favicon.ico" type ="image/x-icon"/>
        <link rel="stylesheet" href="../Style/siteTemplate.css" type="text/css">
        <link rel="stylesheet" href="Games_List.css" type="text/css">
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
                    <li><a href="/Games_Library/Games_List.php" style="color: rgb(232, 192, 97)"><span>Game Library</span><img alt="navImage" src="/Images/Nav/library.png"></a></li>
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
        <div class="main_section"> 
            <div class="filter">
                <form method="get">
                    <div class="category">
                        <p>Category:</p>
                        <div id="list1" class="dropdown-check-list" tabindex="100">
                            <span class="anchor">
                                Select Categories
                                <svg height="12" width="20">
                                    <polygon points="0,0 20,0 10,12"></polygon>
                                </svg>
                            </span>

                            <ul class="items">
                                <?php
                                    include 'Categories.php';
                                    $categories = fetchCategories();
                                    foreach($categories as $category){
                                        echo '  <li>
                                                    <input type="checkbox" name="category[]" id="'. $category .'" value="'. $category .'"/>
                                                    <label for="'. $category .'">'. $category .'</label>
                                                </li>';
                                    }
                                ?>
                            </ul>
                          </div>
                          <script>
                                var checkList = document.getElementById('list1');
                                checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
                                if (checkList.classList.contains('visible'))
                                    checkList.classList.remove('visible');
                                else
                                    checkList.classList.add('visible');
                                }
                          </script>
                    </div>
                    <div class="release_year">
                        <label for="year">Release year:</label>
                        <input type="text" name="release-year" id="year">
                    </div>
                    <div class="age">
                        <label for="age">Age:</label>
                        <input type="text" name="age" id="age">
                    </div>
                    <div class="search">
                        <label for="search">Search:</label>
                        <input type="text" name="search" id="search">
                    </div>
                    <div class="submit">
                        <input type="submit" name="submit" value="➜">
                    </div>
                </form>
            </div>
            <div class="games_grid">
            <?php
                    if(isset($_SESSION['username'])){
                        echo    '<div class="game-wrapper" id="add-button">
                                    <a href="Add_Game/Add_Game.php">
                                        <div class="add-button">
                                            <img alt="add button" src="/Images/Games_List/plus.png">
                                        </div>
                                    </a>
                                </div>';
                    }
                ?>
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
                <?php
                if(!isset($_SESSION['username']))
                    echo '<a href="/Login/login.php">Login</a>';
                else
                    echo '<a href="/Login/logout.php">Logout</a>';
                ?>
            </div>
        </footer>
        <script src="FetchGames.js"></script> 
    </body>
</html>