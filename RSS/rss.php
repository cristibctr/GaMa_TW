<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
    header( "Content-type: text/xml");
    echo "<?xml version='1.0' encoding='UTF-8'?>
            <rss version='2.0' xmlns:gama='http://localhost/RSS/doc.html'>
            <channel>
            <title>GAMA | RSS</title>
            <link>/</link>
            <description>This feed handles the top voted games and the most popular championships</description>
            <language>en-us</language>";
    try{
        $dbh = DBConnect::getConnection();
        $sth = $dbh->prepare("SELECT name, year, votes from games ORDER BY votes DESC LIMIT 3");
        $sth->execute();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            $name = $row['name'];
            $year = $row['year'];
            $votes = $row['votes'];
            echo "<item>
                    <title>$name</title>
                    <link>http://localhost/Game_page/Game_page.php?name=$name</link>
                    <gama:year>$year</gama:year>
                    <gama:votes>$votes</gama:votes>
                    <category>games</category>
                </item>";
        }
        $sth = $dbh->prepare("SELECT comp, count(nume) AS nrcomp FROM numecomp GROUP BY comp ORDER BY nrcomp DESC LIMIT 3");
        $sth->execute();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            $comp = $row['comp'];
            $nrcomp = $row['nrcomp'];
            echo "<item>
                    <title>$comp</title>
                    <gama:playernr>$nrcomp</gama:playernr>
                    <category>championships</category>
                </item>";
        }
    }
    catch (PDOException $e){
        error_log('PDOException - ' . $e->getMessage(), 0);
        http_response_code(500);
        die('Error establishing connection with database');
    }
    echo "</channel>
        </rss>";
?>