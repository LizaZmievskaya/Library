<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$odate = $_POST['odate'];
$rdate = $_POST['rdate'];
$book = $_POST['book'];
$reader = $_POST['reader'];
$id = $_POST['id'];
//Информация об авторе
$stmt1 = $db->prepare("SELECT authors.author_id FROM `books` LEFT JOIN `authors` ON books.author_id=authors.author_id WHERE book_id='$book'");
$stmt1->execute();
$result = $stmt1->fetchAll();
$author_id = $result[0]['author_id'];
//Обновление записи
$stmt = $db->prepare("UPDATE output SET output_date = '$odate', return_date = '$rdate',
book_id = '$book', reader_id = '$reader', author_id = '$author_id' WHERE output_id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/tables/output.php");