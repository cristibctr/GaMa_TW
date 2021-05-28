<?php
require_once($_SERVER['DOCUMENT_ROOT']."/DBConnect/DBConnect.php");

require('phplot.php');
require('mem_image.php');
$dbh = DBConnect::getConnection();
switch($_GET['format']){
    case 'csv':
        csv($dbh);
        break;
    case 'pdf':
        pdf($dbh);
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
    header('Content-Disposition: attachment; filename="statistics.csv";');
    fpassthru($f);
}
function pdf($dbh){
    
    $pdf = new PDF_MemImage();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',24);
    $pdf->Cell(0,10,'GAMA statistics',0,1,'C');
    $pdf->Ln(20);
    $pdf->SetFont('Arial','U',16);
    $pdf->Cell(0,10,'Top 5 Games',0,1);
    $sth = $dbh->prepare("SELECT name, year, votes from games ORDER BY votes DESC LIMIT 5");
    $sth->execute();
    $pdf->SetFont('Arial','',12);
    while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(0,6, '       '.$row['name'].': Game was released in '.$row['year'].' and it has '.$row['votes'].' votes',0,1); 
        $dataGames[] = array($row['name'].' ('.$row['year'].')', $row['votes']);
    }
    $graph = drawBar($dataGames, array('Votes'), 'Top 5 games by number of votes', 500, 300);
    $pdf->Ln(5);
    $pdf->GDImage($graph->img);
    $pdf->SetFont('Arial','U',16);
    $sth = $dbh->prepare("SELECT count(*) as nr from games");
    $sth->execute();
    $pdf->Cell(70,10,'Total number of games: '. $sth->fetch(PDO::FETCH_ASSOC)['nr'],0,1);
    $pdf->Cell(0,10,'Number of games by category',0,1);
    $sth = $dbh->prepare("SELECT category, count(category) as category_count FROM game_category GROUP BY category");
    $sth->execute();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
        $dataCategories[] = array($row['category'], $row['category_count']);
    }
    $graph = drawPie($dataCategories, 'Number of games in each category', 700, 300);
    $pdf->Ln(5);
    $pdf->GDImage($graph->img);
    $pdf->Output();
    //$pdf->Output('D','statistics.pdf');
}
function drawBar($data, $represents, $title, $w, $h){
    $plot = new PHPlot($w, $h);
    $plot->SetImageBorderType('plain');
    $plot->SetPlotType('bars');
    $plot->SetDataType('text-data');
    $plot->SetDataValues($data);
    $plot->SetTitle($title);
    $plot->SetLegend($represents);
    $plot->SetXTickLabelPos('none');
    $plot->SetXTickPos('none');
    $plot->SetPrintImage(false);
    $plot->DrawGraph();
    return $plot;
}
function drawPie($data, $title, $w, $h){
    $plot = new PHPlot($w, $h);
    $plot->SetImageBorderType('plain');
    $plot->SetPlotType('pie');
    $plot->SetDataType('text-data-single');
    $plot->SetDataValues($data);
    $plot->SetDataColors(array('red', 'green', 'blue', 'yellow', 'cyan',
                            'magenta', 'brown', 'lavender', 'pink',
                            'gray', 'orange', 'orchid', 'plum', 'navy'));
    $plot->SetTitle($title);
    foreach ($data as $row)
      $plot->SetLegend(implode(': ', $row));
    $plot->SetLegendPixels(5, 5);
    $plot->SetShading(0);
    $plot->SetPrintImage(false);
    $plot->DrawGraph();
    return $plot;
}
?>