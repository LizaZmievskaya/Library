<?php
require('fpdf181/fpdf.php');
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET CHARACTER SET cp1251_koi8");

$stmt = $db->prepare("SELECT output_date, second_name, first_name, book_name, auth_name
FROM `output` LEFT JOIN `books` ON output.book_id=books.book_id
LEFT JOIN `readers` ON output.reader_id=readers.reader_id
LEFT JOIN `authors` ON output.author_id=authors.author_id WHERE return_date=0 ORDER BY output_date");
$stmt->execute();
$rows = $stmt->fetchAll();

$stmt1 = $db->prepare("SELECT * FROM `titles`");
$stmt1->execute();
$title = $stmt1->fetchAll();

$pdf = new FPDF();
$pdf->AddFont('ArialMT','B','arial.php');
$pdf->AddPage();
$pdf->SetFont('ArialMT','B',14);
$pdf->Cell(165,10,$title[0]['debtors'],'','','C');
$pdf->Ln();
$pdf->SetFont('ArialMT','B',11);
$pdf->SetFillColor(204, 204, 255);
$pdf->Cell(30,10,$title[0]['date'],1,0,'',1);
$pdf->Cell(50,10,$title[0]['name'],1,0,'',1);
$pdf->Cell(60,10,$title[0]['book'],1,0,'',1);
$pdf->Cell(50,10,$title[0]['auth'],1,0,'',1);

for ($i = 0; $i < count($rows); $i++){
    $pdf->SetFont('ArialMT','B',10);
    $pdf->Ln();
    $pdf->Cell(30,10,date('d.m.Y', strtotime($rows[$i]['output_date'])),1);
    $pdf->Cell(50,10,$rows[$i]['second_name'].' '.$rows[$i]['first_name'],1);
    $pdf->Cell(60,10,$rows[$i]['book_name'],1);
    $pdf->Cell(50,10,$rows[$i]['auth_name'],1);
}
$pdf->Output();
