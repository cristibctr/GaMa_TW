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
                    <li><a href="/Join/join.html"><span>Competitions</span><img alt="navImage" src="/Images/Nav/competition.png"></a></li>
                    <li><a href="/Login/login.html"><span>Login</span><img alt="navImage" src="/Images/Nav/login.png"></a></li>
                </ul>
            </nav>
        </header>
        <div class="main_section"> 
            <div class="filter">
                <form>
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
                        <p>Release year:</p>
                        <input type="text" name="release-year">
                    </div>
                    <div class="age">
                        <p>Age:</p>
                        <input type="text" name="age">
                    </div>
                    <div class="search">
                        <p>Search:</p>
                        <input type="text" name="search">
                    </div>
                    <div class="submit">
                        <input type="submit" name="submit" value="➜">
                    </div>
                </form>
            </div>
            <div class="games_grid">
                <!--These are going to be generated with php from the database-->
                <?php
                    include 'games_fetch.php';
                    fetchGames();
                ?>
                <div class="game-wrapper">
                    <a href="Add_Game/Add_Game.html">
                        <div class="add-button">
                            <img alt="add button" src="/Images/Games_List/plus.png">
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <a href="../Dashboard/Dashboard.html" class="dashboard-button">
            <img alt="image" src="../Images/Index/speedometer.svg" style="width:70%;">
        </a>
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
                <a href="../Join/join.html">Competitions</a>
                <a href="../Login/login.html">Login</a>
            </div>
        </footer>
    </body>
</html>