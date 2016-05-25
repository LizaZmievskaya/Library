<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$name = $_POST['name'];
$city = $_POST['city'];
$email = $_POST['email'];
$site = $_POST['site'];
$phone = $_POST['phone'];
$stmt = $db->prepare("INSERT INTO publishers VALUES ('','$name','$city','$phone','$email','$site')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/tables/publishers.php");