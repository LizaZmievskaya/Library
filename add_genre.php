<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$genre = $_POST['genre'];
$stmt = $db->prepare("INSERT INTO genres VALUES ('','$genre')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/tables/genres.php");