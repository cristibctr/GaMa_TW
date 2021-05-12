<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
    if(isset($_POST['register'])){
        $username = $_POST['uname'];
        $passw = $_POST['psw'];
        $passw = md5($passw);
        $email = $_POST['email'];
        if(empty($username) || empty($passw) || empty($email))
        {
            echo "<script>
                alert('Please complete all fields');
                window.location.href='/Login/login.php';
                </script>";
            exit();
        }
        try{
            $dbh = DBConnect::getConnection();
            $sth = $dbh->prepare("SELECT username FROM users WHERE username=? LIMIT 1");
            $sth->execute([$username]);
            if($sth->rowCount() > 0){
                echo "<script>
                alert('Username already exists');
                window.location.href='/Login/login.php';
                </script>";
                exit();
            }
            $sth = $dbh->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $sth -> bindParam(1, $username);
            $sth -> bindParam(2, $email);
            $sth -> bindParam(3, $passw);
            $sth->execute();
            $sth = $dbh->prepare("SELECT admin FROM users WHERE username=?");
            $sth->execute([$usernam]);
            $_SESSION['username'] = $username;
            $_SESSION['admin'] = $sth->fetch(PDO::FETCH_ASSOC)['admin'];
            header("Location: /index.php");
        }
        catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(500);
            die('Error establishing connection with database'.$e);
        }
    }
    if(isset($_POST['login'])){
        $username = $_POST['uname'];
        $passw = $_POST['psw'];
        $passw = md5($passw);
        if(empty($username) || empty($passw))
        {
            echo "<script>
                alert('Please complete all fields');
                window.location.href='/Login/login.php';
                </script>";
            exit();
        }
        try{
            $dbh = DBConnect::getConnection();
            $sth = $dbh->prepare("SELECT * FROM users WHERE username=? AND password=? LIMIT 1");
            $sth -> bindParam(1, $username);
            $sth -> bindParam(2, $passw);
            $sth->execute();
            if($sth->rowCount() == 0){
                echo "<script>
                    alert('Username or password incorrect');
                    window.location.href='/Login/login.php';
                    </script>";
                exit();
            }
            $_SESSION['username'] = $username;
            $_SESSION['admin'] = $sth->fetch(PDO::FETCH_ASSOC)['admin'];
            header("Location: /index.php");
        }
        catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(500);
            die('Error establishing connection with database'.$e);
        }
    }
?>