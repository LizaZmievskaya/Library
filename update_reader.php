<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$sname = $_POST['sname'];
$fname = $_POST['fname'];
$adress = $_POST['adress'];
$passport = $_POST['passport'];
$phone = $_POST['phone'];
$id = $_POST['id'];
$stmt = $db->prepare("UPDATE readers SET second_name = '$sname', first_name = '$fname',
adress = '$adress', passport = '$passport', phone_num = '$phone' WHERE reader_id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/tables/readers.php");