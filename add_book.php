<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$name = $_POST['name'];
$year = $_POST['year'];
$pages = $_POST['pages'];
$price = $_POST['price'];
$publish = $_POST['publish'];
$lang = $_POST['lang'];
$auth = $_POST['auth'];
$genre = $_POST['genre'];
$stmt = $db->prepare("INSERT INTO books VALUES ('','$name','$year','$pages','$price','$publish','$lang','$auth','$genre')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/tables/books.php");