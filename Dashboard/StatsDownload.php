<?php
require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");
$dbh = DBConnect::getConnection();
switch($_GET['format']){
    case 'csv':
        csv($dbh);
        break;
    case 'pdf':
        break;
    case 'docbook':
        break;
    case 'minimal':
        break;
    default:
        break;
}
function csv($dbh){
        $sth = $dbh->prepare("SELECT name, year, votes from games ORDER BY votes DESC LIMIT 3");
        $sth->execute();
        $f = fopen('php://memory', 'w'); 
        fputcsv($f, array('Top 3 Games'));
        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($f, array($row['name'], $row['year'], $row['votes']), ','); 
        }
        $sth = $dbh->prepare("SELECT count(*) from games");
        $sth->execute();
        fputcsv($f, array('Number of games total'));
        fputcsv($f, $sth->fetch(PDO::FETCH_ASSOC), ',');
        $sth = $dbh->prepare("SELECT category, count(category) as category_count FROM game_category GROUP BY category");
        $sth->execute();
        fputcsv($f, array('Number of games by category'));
        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($f, array($row['category'], $row['category_count']), ','); 
        }
        fseek($f, 0);
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="export.csv";');
        fpassthru($f);
}
?>