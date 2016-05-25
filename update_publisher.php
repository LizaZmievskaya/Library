<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$name = $_POST['name'];
$city = $_POST['city'];
$email = $_POST['email'];
$site = $_POST['site'];
$phone = $_POST['phone'];
$id = $_POST['id'];
$stmt = $db->prepare("UPDATE publishers SET publish_name = '$name', city = '$city', phone_num = '$phone',
e_mail = '$email', web_site = '$site' WHERE publisher_id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/tables/readers.php");