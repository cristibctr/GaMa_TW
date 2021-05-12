<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
    if(isset($_POST['register'])){
        $username = $_POST['uname'];
        $passw = $_POST['psw'];
        $email = $_POST['email'];
        if(empty($username) || empty($passw) || empty($email))
        {
            echo "<script>
                alert('Please complete all fields');
                window.location.href='/Login/login.php';
                </script>";
            exit();
        }
        $pepper = "random string for pepper";
        $pwd_peppered = hash_hmac("sha256", $passw, $pepper);
        $pwd_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);
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
            $sth -> bindParam(3, $pwd_hashed);
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
            die('Error establishing connection with database');
        }
    }
    if(isset($_POST['login'])){
        $username = $_POST['uname'];
        $passw = $_POST['psw'];
        if(empty($username) || empty($passw))
        {
            echo "<script>
                alert('Please complete all fields');
                window.location.href='/Login/login.php';
                </script>";
            exit();
        }
        $pepper = "random string for pepper";
        $pwd_peppered = hash_hmac("sha256", $passw, $pepper);
        try{
            $dbh = DBConnect::getConnection();
            $sth = $dbh->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
            $sth->execute([$username]);
            if($sth->rowCount() > 0){
                $userData = $sth->fetch(PDO::FETCH_ASSOC);
                $fetchedPwd = $userData['password'];
                if(!password_verify($pwd_peppered, $fetchedPwd)){
                    echo "<script>
                        alert('Username or password incorrect');
                        window.location.href='/Login/login.php';
                        </script>";
                    exit();
                }
            }
            else{
                echo "<script>
                        alert('Username or password incorrect');
                        window.location.href='/Login/login.php';
                        </script>";
                    exit();
            }
            $_SESSION['username'] = $username;
            $_SESSION['admin'] = $userData['admin'];
            header("Location: /index.php");
        }
        catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(500);
            die('Error establishing connection with database');
        }
    }
?>