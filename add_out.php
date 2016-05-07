<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$odate = $_POST['odate'];
$rdate = $_POST['rdate'];
$book = $_POST['book'];
//$author = $_POST['author'];
$fname = $_POST['fname'];
$sname = $_POST['sname'];
$reader_id = $db->exec("SELECT reader_id FROM `readers` WHERE first_name='$fname' AND second_name='$sname'");
$author_id = $db->exec("SELECT auth_id FROM `books` LEFT JOIN `authors` ON books.author_id=authors.author_id WHERE book_name='$book'");
$stmt = $db->prepare("INSERT INTO output VALUES ('','$odate','$rdate','$book','$reader_id','$author_id')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/countries.php");