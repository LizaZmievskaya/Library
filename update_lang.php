<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$language = $_POST['language'];
$id = $_POST['id'];
$stmt = $db->prepare("UPDATE languages SET language = '$language' WHERE lang_id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/countries.php");