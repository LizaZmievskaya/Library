<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$author = $_POST['author'];
$stmt = $db->prepare("UPDATE authors SET auth_name = '$author' WHERE author_id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/tables/authors.php");