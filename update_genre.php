<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$genre = $_POST['genre'];
$stmt = $db->prepare("UPDATE genres SET genre = '$genre' WHERE id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/tables/genres.php");