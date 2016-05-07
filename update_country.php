<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$country = $_POST['country'];
$id = $_POST['id'];
$stmt = $db->prepare("UPDATE countries SET country = '$country' WHERE country_id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/countries.php");