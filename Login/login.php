<?php
session_start();
if(isset($_SESSION['username'])){
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
        <link rel="stylesheet" href="../Style/siteTemplate.css" type="text/css">
        <link rel="stylesheet" href="stylelogin.css" type="text/css">
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
                    <li><a href="/Login/login.php" style="color: rgb(232, 192, 97)"><span>Login</span><img alt="navImage" src="/Images/Nav/login.png"></a></li>
                </ul>
            </nav>
        </header>
      <div class="hero">
            
            <div class="form-box">
                 <div class="main" id="merge">LOGIN</div>
                     <div class="titlepage">
                 
               
               
                         <form id="login" class="text-group" method="POST" action="LogAndReg.php">
                   
                                <p>Username</p>
                                    <input type="text" class="input-txt"  name="uname" required><br><br>
                                    <label for="psw"><b>Password</b></label>
                                    <input type="password" class="input-txt" name="psw" required>
                     
                                    <button type="submit" class="submit" name="login">SUBMIT</button><br><br>
                                                <p>Don't have an account yet?</p>
                                    <button type="button" class="clickregister" onclick="register()">Register</button>
                                </form>
                </div>

            <div class="titlepage">
            
                <form id="register" class="text-group" method="POST" action="LogAndReg.php">
                    

                    <label for="uname"><b>Enter Username</b></label>

                    <input type="text" class="input-txt" name="uname" id="uname" required><br><br>
                    
                    <label for="email"><b>Enter Email</b></label>  

                    <input type="email" class="input-txt" name="email" id="email" required><br><br>

                    <label for="psw"><b>Enter password</b></label>

                    <input type="password" class="input-txt" name="psw" id="psw" required>

                    <button type="submit" class="submit" name="register">Register Now</button>
                
        
                </form>
            </div>
        </div>
            
        </div>
        <script>
            var x=document.getElementById("login");
            var y=document.getElementById("register");
           
            var a=document.getElementById("merge");
           
            function register(){
                x.style.left="-400px";
                y.style.left="50px";
                a.innerHTML="REGISTER";
                
            
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
                <a href="../Login/login.php">Login</a>
            </div>
        </footer>
    </body>
</html>