<?php
class DBConnect{
    private static $dbh = NULL;

    private function __construct() {
        
    }

    public static function getConnection(){
        if(self::$dbh == NULL){
            try{
                self::$dbh = new PDO('mysql:host=localhost;dbname=gama_tw', 'root', '');
                self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                echo('PDOException - ' . $e->getMessage());
                http_response_code(500);
                die('Error establishing connection with database');
            }
            return self::$dbh;
        }
        else return self::$dbh;
    }
}
?>