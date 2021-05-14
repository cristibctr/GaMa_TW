<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
    if(isset($_SESSION['username'])){
        if(isset($_POST['submit_upvote_x']))
        {
            $username = $_SESSION['username'];
            $gameName = $_POST['game_name'];
            try{
                $dbh = DBConnect::getConnection();
                $sth = $dbh->prepare("SELECT vote_type, game_name FROM user_vote WHERE username=? AND game_name=?");
                $sth->bindParam(1, $username);
                $sth->bindParam(2, $gameName);
                $sth->execute();
                if($sth->rowCount() > 0){
                    $voteType = $sth->fetch(PDO::FETCH_ASSOC)['vote_type'];
                    if($voteType == 'downvote'){
                        $sth = $dbh->prepare("UPDATE user_vote SET vote_type = 'upvote' WHERE username=? AND game_name=?");
                        $sth->bindParam(1, $username);
                        $sth->bindParam(2, $gameName);
                        $sth->execute();
                        $sth = $dbh->prepare("UPDATE games SET votes = votes+2 WHERE name=?");
                        $sth->bindParam(1, $gameName);
                        $sth->execute();
                    }
                    else{
                        $sth = $dbh->prepare("DELETE FROM user_vote WHERE username=? AND game_name=?");
                        $sth->bindParam(1, $username);
                        $sth->bindParam(2, $gameName);
                        $sth->execute();
                        $sth = $dbh->prepare("UPDATE games SET votes = votes-1 WHERE name=?");
                        $sth->bindParam(1, $gameName);
                        $sth->execute();
                    }
                }
                else{
                    $sth = $dbh->prepare("INSERT INTO user_vote (username, game_name, vote_type) VALUES (?, ?, 'upvote')");
                    $sth->bindParam(1, $username);
                    $sth->bindParam(2, $gameName);
                    $sth->execute();
                    $sth = $dbh->prepare("UPDATE games SET votes = votes+1 WHERE name=?");
                    $sth->bindParam(1, $gameName);
                    $sth->execute();
                }
            }
            catch(PDOException $e){
                error_log('PDOException - ' . $e->getMessage(), 0);
                http_response_code(500);
                die('Error establishing connection with database'.$e);
            }
        }
        else if(isset($_POST['submit_downvote_x']))
        {
            $username = $_SESSION['username'];
            $gameName = $_POST['game_name'];
            try{
                $dbh = DBConnect::getConnection();
                $sth = $dbh->prepare("SELECT vote_type, game_name FROM user_vote WHERE username=? AND game_name=?");
                $sth->bindParam(1, $username);
                $sth->bindParam(2, $gameName);
                $sth->execute();
                if($sth->rowCount() > 0){
                    $voteType = $sth->fetch(PDO::FETCH_ASSOC)['vote_type'];
                    if($voteType == 'upvote'){
                        $sth = $dbh->prepare("UPDATE user_vote SET vote_type = 'downvote' WHERE username=? AND game_name=?");
                        $sth->bindParam(1, $username);
                        $sth->bindParam(2, $gameName);
                        $sth->execute();
                        $sth = $dbh->prepare("UPDATE games SET votes = votes-2 WHERE name=?");
                        $sth->bindParam(1, $gameName);
                        $sth->execute();
                    }
                    else{
                        $sth = $dbh->prepare("DELETE FROM user_vote WHERE username=? AND game_name=?");
                        $sth->bindParam(1, $username);
                        $sth->bindParam(2, $gameName);
                        $sth->execute();
                        $sth = $dbh->prepare("UPDATE games SET votes = votes+1 WHERE name=?");
                        $sth->bindParam(1, $gameName);
                        $sth->execute();
                    }
                }
                else{
                    $sth = $dbh->prepare("INSERT INTO user_vote (username, game_name, vote_type) VALUES (?, ?, 'downvote')");
                    $sth->bindParam(1, $username);
                    $sth->bindParam(2, $gameName);
                    $sth->execute();
                    $sth = $dbh->prepare("UPDATE games SET votes = votes-1 WHERE name=?");
                    $sth->bindParam(1, $gameName);
                    $sth->execute();
                }
            }
            catch(PDOException $e){
                error_log('PDOException - ' . $e->getMessage(), 0);
                http_response_code(500);
                die('Error establishing connection with database');
            }
        }
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>